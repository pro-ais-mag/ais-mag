<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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
    //protected $redirectTo = '/home';
    public function redirectTo(){
        //ini_set(0);
        $position = Auth::user()->position;

        switch($position){
            case 'Consumerables':
                return '/user';
                break;
            case 'Line Manager':
                return '/line-manager-analysis';
                break;
            case 'Reception':
                return '/allquotes';
                break;  
            case 'Estimator':
                return '/allquotes';
                break;
            case 'Administrator':
                return '/administrator';
                break;
            case 'Assessors':
                return '/allquotes'; 
                break;                 
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
