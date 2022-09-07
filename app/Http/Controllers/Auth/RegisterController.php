<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use CountryState;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'             => ['required', 'numeric'],
            'country'           => ['required'],
            'state'             => ['required_without:other_state'],
            'other_state'       => ['required_without:state'],
            'company_name'      => ['required'],
            'designation'       => ['required'],
            'industry'          =>['required'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'country'       => CountryState::getCountryName($data['country']),
            'state'         => (isset($data['other_state'])) ? $data['other_state']: CountryState::getStateName($data['state'], $data['country']),
            'company_name'  => $data['company_name'],
            'designation'   => $data['designation'],
            'industry'      => $data['industry'],
            'password'      => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm(){

        $countries = CountryState::getCountries();

        return view('auth.register', compact('countries'));
    }

    public function getuRegister(){
        $countries = CountryState::getCountries();

        return view('u.register', compact('countries'));
    }

    public function postuRegister(Request $request){
        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone'             => ['required', 'numeric'],
            'country'           => ['required'],
            'state'             => ['required_without:other_state'],
            'other_state'       => ['required_without:state'],
            'company_name'      => ['required'],
            'designation'       => ['required'],
            'industry'          =>['required'],
        ]);

        $data = $request->all();

        $user = User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'phone'         => $data['phone'],
            'country'       => CountryState::getCountryName($data['country']),
            'state'         => (isset($data['other_state'])) ? $data['other_state']: CountryState::getStateName($data['state'], $data['country']),
            'company_name'  => $data['company_name'],
            'designation'   => $data['designation'],
            'industry'      => $data['industry'],
            'password'      => Hash::make(Str::random()),
        ]);

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
        }
    }
}
