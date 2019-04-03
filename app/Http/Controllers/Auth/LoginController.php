<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;
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
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {

        $username = (string) request()->get('username');
        $user = User::where('username', $username)->orWhere('email', $username)->orWhere('mobile', $username)->first();
        if($user)
        {

            $user = $user->toArray();
            $key = array_search($username, $user);
            $request = request()->all();
            unset($request['username']);
            $request[$key] = $username;
            request()->replace($request);
            // dd($key);
            session()->put('username', $key);
            session()->put('year_id', \App\Year::where('status', 1)->value('id'));
            return $key;
        }
        if(session()->has('username'))
        {
            return session()->get('username');
        }        
        return 'username';
    }


    protected function credentials(Request $request)
    {
        
        return $request->only($this->username(), 'password');
    }







}
