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

        if($result->category_id == 2){

            return view('response.assessment-2', compact('result', 'test'));

        }

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


}
