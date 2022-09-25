<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\ProfileRegisterRequest;
use App\Newkit;
use App\Profile;
use App\Toolkit;
use CountryState;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $title = ($id == '0')? 'PROFILE - GENERIC INFORMATION OF TRUSTWORTHY AI AND STANDARDS':Category::find($id)->name;

        return view('profile.create', compact( 'id','title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //

        $profile = Profile::create([
            'data'=>collect($this->prepare_data($request))
        ]);

        if($request->assessment == 0){
            return view('response.profile');
        }

        if($request->assessment == 1) {

            $test = Category::find($request->assessment);
            if ($test) {
                return redirect()->route('client.test.profile.start', ['slug' => $test->slug, 'profile' => $profile->id]);
            }
        }

        if($request->assessment == 2){

            return redirect()->route('client.test.profile.register', $profile->id);
        }

    }



    public function prepare_data(Request $request): array
    {
        $data = [];

        $arrays = [1, 6, 8, 9, 12];
        for($i =1; $i <= 12; $i++){

            if($request->has('q'.$i) && $request->has('q'.$i.'_name')){
                $name = 'q'.$i.'_name';
                $answer = 'q'.$i;
                if(in_array($i, $arrays)){
                    $other = $answer.'_other';
                    $value =  $request->$answer;
                    if($request->has($other)){
                        $value[] = $request->$other;
                    }
                    $data[] = [
                        'question' => $request->$name,
                        'answer' => $value
                    ];
                }else {
                    $other = $answer.'_other';
                    $data[] = [
                        'question' => $request->$name,
                        'answer' => ($request->$answer == 'Others') ? $request->$other : $request->$answer
                    ];
                }
            }
        }

        return $data;
    }

    public function profile_register($profile){
        $countries = CountryState::getCountries();
        $toolkits = Toolkit::all()->pluck('name','id')->toArray();
        //dd($toolkits);
        return view('profile.register.register', compact( 'profile', 'countries', 'toolkits'));
    }

    public function profile_register_store(ProfileRegisterRequest $request){
        $data = $request->all();
        if($request->filled('attachment')){
            $data['attachment'] = $request->file('attachment')->store('toolkit');
        }

        $new_kit = Newkit::create($data);

        $test = Category::find(2);
        if ($test) {
            return redirect()->route('client.test.profile.start', ['slug' => $test->slug, 'profile' => $new_kit->profile_id]);
        }

    }

//    public function insert(Request $request){
//
//        return Toolkit::create($request->all());
//    }
}
