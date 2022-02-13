<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
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

 
    // protected $redirectTo = '/admin/dashboard';



    protected function redirectTo(){

      
        if (auth()->user()->user_role== 'user') {
          
            return '/employee/dashboard';
        }
        if (!Auth::guest()) {
        return '/admin/dashboard';
        }

        // elseif (auth()->user()->role== 'moderator') {

         
        //     return '/admin/users';
        //     }
    
                return redirect()->back()->withError('error','whoops! You are not authorized to visit this link.');

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
