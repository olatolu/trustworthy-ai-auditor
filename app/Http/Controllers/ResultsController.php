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
        $result = Result::findOrFail($result_id);

        //Prepare Data
        $test = $result->category;

        $description = $test->description;

        $filename = $test->slug."-". time() ."-". $result->id . '.pdf';

        if($test->sections > 0 && $test->radar_chart == 1) {

            $radarData = [];
            $radarLabels = [];
            $radarReportData = [];
            foreach ($result->questions as $question) {

                $radarLabels[] = $question->question_label ?? null;

                $radarData[] = $question->pivot->points;

                $radarReportData[] = null;
            }
        }


        return view('response.assessment-1', compact('result', 'radarData', 'radarLabels', 'test', 'description', 'filename', 'radarReportData'));

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
