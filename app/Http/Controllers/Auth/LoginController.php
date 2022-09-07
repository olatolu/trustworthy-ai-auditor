<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function getuCheck(){
        return view('u.check');
    }

    public function postuCheck(Request $request){

        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::whereEmail($request->email)->first();

        if($user && $user->isAdmin == false){
            Auth::login($user);
            if(\auth()->check()){
                //return to intended
                if(session()->has('url.intended')){
                    $url = session('url.intended');
                    session()->forget('url.intended');
                    return redirect(url($url));
                }
                return redirect(url('/'));
            }
        }elseif ($user && $user->isAdmin){
            return redirect('login');
        }
        else{
            //return to register
            return  redirect(route('client.getu.register'));
        }
    }
}
