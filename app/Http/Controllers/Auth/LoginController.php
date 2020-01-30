<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function redirectPath()
    {

        if(auth()->user()->roles[0]->name=='Admin'){
            return '/home';
        }elseif(auth()->user()->roles[0]->name=='Grafitex'){
            return '/campaign';
        }elseif(auth()->user()->roles[0]->name=='SGH'){
            return '/store';
        }elseif(auth()->user()->roles[0]->name=='tiendas'){
            return '/tienda';
        }

    }

}
