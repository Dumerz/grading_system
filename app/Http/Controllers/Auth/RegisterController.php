<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\VerifyUser;
use App\Notifications\User\Verify;
use App\Notifications\User\Verified;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

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
    protected $redirectTo = '/login';

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
      $messages = [
          'regex'    => 'The :attribute is not an acceptable name value.',
          'name.regex'    => 'The :attribute is not an acceptable username value.',
          'password.regex'    => 'The :attribute complexity is not acceptable.'
      ];
        return Validator::make($data, [
          'name' => 'required|string|max:255|min:6|unique:users|regex:/^[\pL\d]+(?:[\pL\d\_\.]+)*$/u',
          'name_first' => 'required|required|regex:/^[\pL]+(?:[\pL\s\-\.]+)*$/u|min:2|max:255',
          'name_middle' => 'nullable|regex:/^[\pL]+(?:[\pL\s\-\.]+)*$/u|max:255',
          'name_last' => 'required|required|regex:/^[\pL]+(?:[\pL\s\-\.]+)*$/u|min:2|max:255',
          'name_suffix' => 'nullable|alpha|max:255',
          'gender' => 'required|in:MALE,FEMALE',
          'email' => 'required|string|email|max:255|unique:users',
          'password' => 'required|string|min:8|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).{8,}$/',
      'date_birth' => 'required|date|before_or_equal:' . date('Y-m-d')
        ], $messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'name_first' => Str::title($data['name_first']),
            'name_middle' => Str::title($data['name_middle']),
            'name_last' => Str::title($data['name_last']),
            'name_suffix' => Str::title($data['name_suffix']),
            'gender' => $data['gender'],
            'date_birth' => $data['date_birth'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        $this->sendVerifyMessage($user->id);

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
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

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();

        if(isset($verifyUser) ){

            $user = $verifyUser->user;
            if($user->status == 'USRSTAT001') {
                $verifyUser->user->status = 'USRSTAT002';
                $verifyUser->user->save();
                $status = "Your e-mail is verified. You can now login.";
                $user->notify(new Verified($user));
            }

            else{
                $status = "Your e-mail is already verified. You can now login.";
            }
        }

        else{
            return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
        }

        return redirect('/login')->with('status', $status);
    }

    protected function registered(Request $request, $user)
    {
        $this->guard()->logout();
        return redirect('/login')->with('status', 'We sent you an verification link. Check your email and click on the link to verify.');
    }
}
