<?php

namespace App\Http\Controllers;

use App\Category;
use App\Notifications\SendResultsPdfNotification;
use App\Notifications\SendRoomResultEmail;
use App\Result;
use DOMDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use mikehaertl\wkhtmlto\Pdf;


class ResultsController extends Controller
{
    public function show($result_id)
    {
        $result = Result::whereHas('user', function ($query) {
            $query->whereId(auth()->id());
        })->findOrFail($result_id);

        return view('client.test.results', compact('result'));
    }

    public function send($result_id)
    {
        $result = Result::whereHas('user', function ($query) {
            $query->whereId(auth()->id());
        })->findOrFail($result_id);

        //Prepare Data
        $test = $result->category;

        $user = $result->user;

        $filename = $test->slug."-". time() ."-". $result->id . '.pdf';

        $dom = new DOMDocument();
        $dom->loadHTML(mb_convert_encoding($test->description, 'HTML-ENTITIES', 'UTF-8'));
        $images = $dom->getElementsByTagName('img');
        foreach ($images as $image) {
            $src = $image->getAttribute('src');
            $type = pathinfo($src, PATHINFO_EXTENSION);
            $data = file_get_contents( public_path($src));
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            $image->setAttribute("src", $base64);
        }
        $description = $dom->saveHTML();

        if($test->bar_chart == 1 && $test->bar_chart_section > 0){

            $bar_chart_section = $test->bar_chart_section;

            $barData = [];

            $barQuestions = $result->questions->where('section',$bar_chart_section);


            foreach ($barQuestions as $data){

                $barData[$data->pivot->points] = ($data->question_label != null)? $data->question_label : $test->sections_labels->$bar_chart_section."  (Q".$data->id.")";

            }

            $bar_label = ($test->bar_chart_label != null) ? $test->bar_chart_label : $test->sections_labels->$bar_chart_section;


        }else{
            $bar_label = null;
            $barData = null;
            $barQuestions = null;
        }

        if($test->sections > 0 && $test->radar_chart == 1){

            $radarData = [];
            $radarLabels = [];

            for ($i = 1; $i <= $test->sections; $i++ ){

                $radarLabels[] = $test->sections_labels->$i;

                if($result->questions->where('section',$i)->count()>0){

                    $radarData[] = round($result->questions->where('section',$i)->sum('pivot.points') / $result->questions->where('section',$i)->count(), 1) ;

                }else{

                    $radarData[] = round($result->questions->where('section',$i)->sum('pivot.points'), 1) ;
                }

            }

        }else{
            $radarData = null;
            $radarLabels = null;
        }

        if(isset($filename)){

            $render = view('client.test.chart', compact('result', 'radarData', 'radarLabels', 'user', 'test', 'description', 'barQuestions', 'bar_label', 'barData'));

            $pdf = new Pdf;
            $pdf->addPage($render);

            $pdf->setOptions(['javascript-delay' => 5000]);
            $pdf->saveAs(storage_path('pdf/'.$filename));

            try{

                //code to send the mail
                auth()->user()->notify(new SendResultsPdfNotification($filename));
                $result->is_report = 1;

            }catch(\Swift_TransportException $transportExp){
                //$transportExp->getMessage();
            }

            if($result->pdf != null && file_exists(storage_path('pdf/'.$result->pdf))){

                File::delete(storage_path('pdf/'.$result->pdf));
            }

            $result->pdf = $filename;

            $result->save();

            return redirect()->route('client.results.show', $result->id)->withStatus('Your test report has been sent successfully!');

        }else{
            return redirect()->route('client.results.show', $result->id)->withStatus('Something went wrong Please try again later.');
        }

    }

    public function report($result_id)
    {
        if(auth()->check() && (auth()->user()->is_admin)) {
            $result = Result::whereHas('user', function ($query) {
                $query->where('total_points', '>', 0);
            })->findOrFail($result_id);
        }else{

            $result = Result::whereHas('user', function ($query) {
                $query->where('total_points', '>', 0);
                //$query->where('user_id', auth()->user()->id);
            })->findOrFail($result_id);
        }

        //Prepare Data
        $test = $result->category;

        $user = $result->user;

        $description = $test->description;

        $filename = $test->slug."-". time() ."-". $result->id . '.pdf';

        if($test->sections > 0 && $test->radar_chart == 1){

            $radarData = [];
            $radarLabels = [];
            $radarReportData = [];
            for ($i = 1; $i <= $test->sections; $i++ ){

                $radarLabels[] = $test->sections_labels->$i;

                if($result->questions->where('section',$i)->count()>0){

                    $score = round($result->questions->where('section',$i)->sum('pivot.points') / $result->questions->where('section',$i)->count(), 1);

                    $radarData[] = $score;

                    $testReport = $test->categoryReports->where('is_for', 'section')->where('section_id',$i)->first();

                    if($testReport && $test->is_demo == 0) {
                        $test_report = collect(array_reverse((array)$testReport->sections_descriptions, true));

                        foreach ($test_report as $key => $scoreDesc) {

                            if ($score <= $key) {
                                $radarReportData[$i] = $scoreDesc;
                            }
                        }
                    }elseif($testReport && $test->is_demo == 1){

                        $radarReportData[$i] = $testReport->demo_description;
                    }else{

                        $radarReportData[$i] = null;
                    }
                }else{
                    $score = round($result->questions->where('section',$i)->sum('pivot.points'), 1);

                    $radarData[] = $score;

                    $testReport = $test->categoryReports->where('is_for', 'section')->where('section_id',$i)->first();

                    if($testReport && $test->is_demo == 0) {
                        $test_report = collect(array_reverse((array)$testReport->sections_descriptions, true));

                        foreach ($test_report as $key => $scoreDesc) {

                            if ($score <= $key) {
                                $radarReportData[$i] = $scoreDesc;
                            }
                        }
                    }elseif($testReport && $test->is_demo == 1){

                        $radarReportData[$i] = $testReport->demo_description;
                    }else{

                        $radarReportData[$i] = null;
                    }
                }
            }

        }else{
            $radarData = null;
            $radarLabels = null;
            $radarReportData = null;
        }

        if($test->bar_chart == 1 && $test->bar_chart_section > 0){

            $bar_chart_section = $test->bar_chart_section;

            $barData = [];

            $barQuestions = $result->questions->where('section',$bar_chart_section);


            foreach ($barQuestions as $data){

                $barData[$data->pivot->points] = ($data->question_label != null)? $data->question_label : $test->sections_labels->$bar_chart_section."  (Q".$data->id.")";

            }

            $bar_label = ($test->bar_chart_label != null) ? $test->bar_chart_label : $test->sections_labels->$bar_chart_section;


        }else{
            $bar_label = null;
            $barData = null;
            $barQuestions = null;
        }

        if($result->is_report == 0) {

            try {

                //code to send the mail
                $result->user->notify(new SendResultsPdfNotification($result));
                $result->is_report = 1;
                $result->save();

            } catch (\Swift_TransportException $transportExp) {
                //$transportExp->getMessage();
            }

        }

        return view('client.test.chart-main', compact('result', 'radarData', 'radarLabels', 'user', 'test', 'description', 'barQuestions', 'bar_label', 'barData', 'filename', 'radarReportData'));


    }

    /***
     * ClassROmm Report
     *
     */

    public function Creport(Request $request){
        $test = Category::findOrFail($request->category_id);

        //dd($request->all());

        $filename = $test->slug."-". time() .'.pdf';

        $results = $test->categoryResults->pluck('total_points', 'id')->sort();
        $users = count($results);
        //dd($results);
        $levels = [];
        $levels[0] = $levels[1] = $levels[2] = 0;
        $count1 = $count2 = $count3 = 0;
        foreach ($results as $score){
            if($score >= 0 && $score <= 4){
                $count1 ++;
            }elseif ($score > 4 && $score <= 7){
                $count2 ++;
            }elseif ($score > 7 && $score <= 10){
                $count3 ++;
            }
        }

        //dd($levels);

        $grades = [round(($count1/$users)*100), round(($count2/$users)*100), round(($count1/$users)*100)];

        //dd($grades);

        if($request->has('mail') && $request->mail == 1){
            $mailresults = $test->categoryResults;
            foreach ($mailresults as $result) {
                if ($result->is_report == 0) {

                    try {

                        //code to send the mail
                        $result->user->notify(new SendRoomResultEmail($result));
                        $result->is_report = 1;
                        $result->save();

                    } catch (\Swift_TransportException $transportExp) {
                        //$transportExp->getMessage();
                    }

                }
            }
        }

        return view('client.test.class-room', compact('test', 'filename', 'grades'));

    }

    public function getCreport($category_id){
        $test = Category::findOrFail($category_id);

        $filename = $test->slug."-". time() .'.pdf';

        $results = $test->categoryResults->pluck('total_points', 'id')->sort();
        $users = count($results);
        //dd($results);
        $levels = [];
        $levels[0] = $levels[1] = $levels[2] = 0;
        $count1 = $count2 = $count3 = 0;
        foreach ($results as $score){
            if($score >= 0 && $score <= 4){
                $count1 ++;
            }elseif ($score > 4 && $score <= 7){
                $count2 ++;
            }elseif ($score > 7 && $score <= 10){
                $count3 ++;
            }
        }

        //dd($levels);

        $grades = [round(($count1/$users)*100), round(($count2/$users)*100), round(($count1/$users)*100)];

        return view('client.test.class-room', compact('test', 'filename', 'grades'));

    }

}
