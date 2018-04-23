<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\User;
use App\VerifyUser;
use App\Notifications\User\Verify;

class VerifyController extends Controller
{
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function verifyAccount()
    {
        return view('auth.verify.email');
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
	  'email' => 'required|string|email|max:255|exists:users']);
	}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleVerifyAccount(Request $request)
    {
	    $this->validator($request->all())->validate();
	    $user = User::where('email', $request['email'])->first();
	    if (isset($user)) {
	    	if ($user->status == "USRSTAT001") {
	    		$this->sendVerifyMessage($user->id);
	    		return redirect('/login')->with('status', 'We sent you an verification link. Check your email and click on the link to verify.');
	    	}
	    	elseif ($user->status == "USRSTAT002") {
	    		return redirect('/login')->with('warning', 'This request is invalid. Your e-mail is already verified.');
	    	}
	    	else{
	    		return redirect('/login')->with('warning', 'This request is invalid. Please contact system adminstrator.');
	    	}
	    }
    }
    public function sendVerifyMessage($id)
    {
        $user = User::where('id', $id)->first();
        $verifyUser = VerifyUser::create([
            'user_id' => $id,
            'token' => str_random(40)
        ]);
        $url = url('register/verify', $user->verifyUser->token);
        $user->notify(new Verify($user, $url));
    }
}
