<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Notifications\User\Updated;
use App\Notifications\User\ChangePassword;


class UserProfileController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
      $this->middleware('activated');
  }
  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function pwdChangeValidator(array $data)
  {
      $messages = [
          'regex'    => 'The :attribute complexity is not acceptable.'
      ];

    return Validator::make($data, [
      'password_new' => 'required|confirmed|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).{8,}$/'
    ], $messages);
  }
  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function updateValidator($id, array $data)
  {
      $messages = [
          'regex'    => 'The :attribute only accepts letters, space, period and dash.',
      ];

    return Validator::make($data, [
      'name_first' => 'required|required|regex:/^[\pL]+(?:[\pL\s\-\.]+)*$/u|min:2|max:255',
      'name_middle' => 'nullable|regex:/^[\pL]+(?:[\pL\s\-\.]+)*$/u|max:255',
      'name_last' => 'required|required|regex:/^[\pL]+(?:[\pL\s\-\.]+)*$/u|min:2|max:255',
      'name_suffix' => 'nullable|alpha|max:255',
      'gender' => 'required|in:MALE,FEMALE',
      'email' => 'required|string|email|max:255|unique:users,email,'.$id,
      'date_birth' => 'required|date|before_or_equal:' . date('Y-m-d')
    ], $messages);
  }
  /**
   * Show the users list.
   * @param App\User
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $id = $this->is_digit($id);
    return view('userprofile.show', ['user' => User::findOrFail($id)]);
  }
  /**
   * Check Userstatus $id as digit.
   * @param App\Usertype $id
   * @param mixed $entry
   * @return mixed $entry
   */
  protected function is_digit($entry)
  {
    if (!ctype_digit($entry)) {
      $entry = -1;
    }
    return (int)$entry;
  }
  protected function notifyUserUpdate(User $user)
  {
      $url = route('user_profile_show', $user->id);
      $receiver = User::find(Auth::user()->id);
      $receiver->notify(new Updated($user, $url));
  }
  protected function notifyUserChangePassword(User $user)
  {
      $url = route('user_profile_show', $user->id);
      $receiver = User::find(Auth::user()->id);
      $receiver->notify(new ChangePassword($user, $url));
  }
  /**
   * Show the user update view.
   *
   * @return \Illuminate\Http\Response
   */
  public function update($id)
  {
    $id = $this->is_digit($id);
    $user = User::findOrFail($id);
    if($user->usertype == 'USRTYPE001' || $user->id != Auth::user()->id)
    {
      return redirect()->route('user_profile_show', $user->id)->with('warning', 'You\'re unauthorized for this request.'); 
    }
    return view('userprofile.update', ['user' => User::findOrFail($id)]);
  }
  /**
   * Handle the user update.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleUpdate($id, Request $request)
  {
    $id = $this->is_digit($id);
    $user = User::findOrFail($id);
      if($user->usertype == 'USRTYPE001' || $user->id != Auth::user()->id)
      {
        return redirect()->route('user_profile_show', $user->id)->with('warning', 'You\'re unauthorized for this request.'); 
      }
      $this->updateValidator($id, $request->all())->validate();
    $user = $this->edit($id, $request->all());
      $this->notifyUserUpdate($user);
    return redirect()->route('user_profile_show', $user->id)->with('status', 'User successfully updated.');
  }
  public function changePassword($id)
  {
    $id = $this->is_digit($id);
    $user = User::findOrFail($id);
    if($user->usertype == 'USRTYPE001' || $user->id != Auth::user()->id)
    {
      return redirect()->route('user_profile_show', $user->id)->with('warning', 'You\'re unauthorized for that request.'); 
    }
    return view('userprofile.pwd_change', ['user' => User::findOrFail($id)]);
  }
  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  protected function edit($id, array $data)
  {
    $user = User::find($id);
    $user->name_first = Str::title($data['name_first']);
    $user->name_middle = Str::title($data['name_middle']);
    $user->name_last = Str::title($data['name_last']);
    $user->name_suffix = Str::title($data['name_suffix']);
    $user->gender = $data['gender'];
    $user->date_birth = $data['date_birth'];
    $user->email = $data['email'];

    $user->save();

    return $user;
  }
  /**
   * Handle the user update.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleChangePassword($id, Request $request)
  {
    $id = $this->is_digit($id);
    $user = User::findOrFail($id);
      if($user->usertype == 'USRTYPE001' && $user->id != Auth::user()->id)
      {
        return redirect()->route('user_profile_show', $user->id)->with('warning', 'You\'re unauthorized for that request.'); 
      }
      $this->pwdChangeValidator($request->all())->validate();
      if (Hash::check($request['password_old'], Auth::user()->password)) {
        $user->password = Hash::make($request['password_new']);
        $user->save();
        $this->notifyUserChangePassword($user);
        return redirect()->route('user_profile_show', $user->id)->with('status', 'User password changed successfully.');
      }
      else {
        return back()->withErrors(['password_old' => 'I did\'nt recognize your password.']);
      }
  }
}
