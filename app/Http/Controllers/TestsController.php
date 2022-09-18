<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreTestRequest;
use App\Notifications\SendResultsPdfNotification;
use App\Option;
use App\Profile;
use App\Result;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use MongoDB\Driver\Session;
use Symfony\Component\HttpFoundation\Response;
use Gate;
use DOMDocument;

class TestsController extends Controller
{
    public function index()
    {

        $tests = Category::whereisActive(1)->orderBy('id')->paginate(10);

        return view('client.test', compact('tests'));
    }

    public function store(StoreTestRequest $request)
    {

        $options = array_filter($request->input('questions'));


        foreach ($options as $key=>$option){
            $options[$key] = $this->passArray($option);
        }

        $options = collect($options);

        $profile = Profile::find($request->profile_id);

        $result = $profile->profileResults()->create([
            'total_points' => $options->sum('point'),
            'category_id'  => $request->category_id,
        ]);

        $questions = $options->mapWithKeys(function ($option) {
            return [$option['question_id'] => [
                'option_id' => $option['option_id'],
                'points' => $option['point']
            ]
            ];
        })->toArray();

        $result->questions()->sync($questions);

        return redirect()->route('client.results.show', $result->id);
    }

    public function getTest($slug){

        $test = Category::whereSlug($slug)->whereisActive(1)->first();

        return redirect()->route('profile.index', $test->id);
    }

    public function test_profile($slug, $profile){

        $test = Category::whereSlug($slug)->whereisActive(1)->first();

        $dateNow = Carbon::now();

        return view('client.test.test', compact('test', 'dateNow', 'profile'));
    }

    private function passArray($string){

        $arr = explode(",",$string);

        $desireArray = array();
        foreach($arr as $value)
        {
            $val = explode("-",$value);
            $desireArray[$val[0]] = $val[1];
        }

        return $desireArray;
    }


//    public function line()
//    {
//        $result = Result::whereHas('user', function ($query) {
//            $query->whereId(auth()->id());
//        })->findOrFail(1);
//
//        //Prepare Data
//        $test = $result->category;
//
//        $user = $result->user;
//
////        $dom = new DOMDocument();
////        $dom->loadHTML(mb_convert_encoding($test->description, 'HTML-ENTITIES', 'UTF-8'));
////        $images = $dom->getElementsByTagName('img');
////        foreach ($images as $image) {
////            $src = $image->getAttribute('src');
////            $type = pathinfo($src, PATHINFO_EXTENSION);
////            $data = file_get_contents( public_path($src));
////            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
////            $image->setAttribute("src", $base64);
////        }
////        $description = $dom->saveHTML();
//
//        $description = $test->description;
//
//        if($test->sections > 0 && $test->radar_chart == 1){
//
//            $radarData = [];
//            $radarLabels = [];
//
//            for ($i = 1; $i <= $test->sections; $i++ ){
//
//                $radarLabels[] = $test->sections_labels->$i;
//
//                $radarData[] = round($result->questions->where('section',$i)->sum('pivot.points') / $result->questions->where('section',$i)->count(), 1) ;
//            }
//
//        }else{
//            $radarData = null;
//            $radarLabels = null;
//        }
//
//        if($test->bar_chart == 1 && $test->bar_chart_section > 0){
//
//            $bar_chart_section = $test->bar_chart_section;
//
//            $barData = [];
//
//            $barQuestions = $result->questions->where('section',$bar_chart_section);
//
//
//            foreach ($barQuestions as $data){
//
//                $barData[$data->pivot->points] = ($data->question_label != null)? $data->question_label : $test->sections_labels->$bar_chart_section."  (Q".$data->id.")";
//
//            }
//
//            $bar_label = ($test->bar_chart_label != null) ? $test->bar_chart_label : $test->sections_labels->$bar_chart_section;
//
//            //dd($barData);
//
//        }else{
//            $bar_label = null;
//            $barData = null;
//            $barQuestions = null;
//        }
//
//        return view('client.test.chart-main', compact('result', 'radarData', 'radarLabels', 'user', 'test', 'description', 'barQuestions', 'bar_label', 'barData'));
//
//
//    }
}
