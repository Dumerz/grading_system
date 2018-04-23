<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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

    public function authenticated(Request $request, $user)
    {
        if ($user->status == 'USRSTAT001') {
        auth()->logout();
            return back()->with('warning', 'You need to confirm your account. We have sent you an activation code, please check your email. <a href="'. url('verify') .'">Resend verification code?</a>');
        }
        
        elseif ($user->status == 'USRSTAT003') {
        auth()->logout();
            return back()->with('warning', 'Your account is not active. Please contact system adminstrator.');
        }

        return redirect()->intended($this->redirectPath());
    }

}
