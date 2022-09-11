<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use CountryState;
use Symfony\Component\HttpFoundation\Response;
use Session;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('client.home');
    }

    public function redirect()
    {
        if (auth()->user()->is_admin) {
            return redirect()->route('admin.home')->with('status', session('status'));
        }
        return redirect()->intended('/');
//        return redirect()->route('client.home')->with('status', session('status'));
    }

    public function getStates(Request $request){

        $states = CountryState::getStates($request->country_id);

        if(count($states) > 0){
            return response()->json($states);
        }else{
            return response()->json(0);
        }

    }

    public function getLanding($slug){


        $test = Category::whereSlug($slug)->whereisActive(1)->first();

        //dd($test);

        abort_if(($test->is_active == 0 && Gate::denies('category_access')), Response::HTTP_NOT_FOUND, 'NOT FOUND');

//        if(!auth()->check()){
//            Session::put('url.intended', url()->full());
//            return redirect(route('client.getu.check'));
//        }else{
            return redirect(route('profile.index', $test->id));
//        }

    }
}
