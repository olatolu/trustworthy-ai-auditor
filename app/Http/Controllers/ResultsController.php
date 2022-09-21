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

            $section_1_score = $result->questions->where('section',1)->sum('pivot.points');
            $section_1_max_score = count($result->questions->where('section',1)) * 5;

            $section_2_score = $result->questions->where('section',2)->sum('pivot.points');
            $section_2_max_score = count($result->questions->where('section',2)) * 5;

            $section_1_score_percent = round((($section_1_score/$section_1_max_score)*100),2);
            $section_2_score_percent = round((($section_2_score/$section_2_max_score)*100),2);

            $over_all_percent = round(($section_1_score_percent + $section_2_score_percent)/2, 2);


            return view('response.assessment-2', compact('result', 'test', 'section_1_score_percent', 'section_2_score_percent', 'over_all_percent'));

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

        $score = $result->questions->sum('pivot.points');

        $max_score = count($result->questions) * 5;

        $score_percent = round((($score/$max_score) * 100), 2);

        $level = self::grade($score_percent);

        return view('response.assessment-1', compact('result', 'radarData', 'radarLabels', 'test', 'description', 'filename', 'radarReportData', 'score_percent', 'level'));

    }

    private function grade($score)
    {

        switch ($score) {

            case($score >= 81):
                $level = 5;
                break;

            case($score >= 61):
                $level = 4;
                break;

            case($score >= 41):
                $level = 3;
                break;

            case($score >= 21):
                $level = 2;
                break;

            case($score >= 0):
                $level = 1;
                break;

            default:
                $level = 1;
        }

        return $level;
    }


}
