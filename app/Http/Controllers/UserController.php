<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Usertype;
use App\Userstatus;
use App\Notifications\User\Updated;
use App\Notifications\User\Deleted;
use App\Notifications\User\Created;
use App\Notifications\User\ChangePassword;

class UserController extends Controller
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
    $this->middleware('admin');
  }

  /**
   * Show the users list.
   *
   * @return \Illuminate\Http\Response
   */
  public function list()
  {
    $users = User::orderBy('name_last', 'asc')->orderBy('name_first', 'asc')->orderBy('name_last', 'asc')->orderBy('name_suffix', 'asc')->paginate(10);
    return view('user.list', compact('users'));
  }

  /**
   * Show the users list.
   * @param App\User
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $id = $this->is_digit($id);
    return view('user.show', ['user' => User::findOrFail($id)]);
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
      'password' => 'required|min:8|confirmed|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).{8,}$/',
      'date_birth' => 'required|date|before_or_equal:' . date('Y-m-d'),
      'usertype' => 'required|exists:usertypes,usertype_id',
      'userstatus' => 'required|exists:userstatus,userstatus_id'
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
      'date_birth' => 'required|date|before_or_equal:' . date('Y-m-d'),
      'usertype' => 'required|exists:usertypes,usertype_id',
      'userstatus' => 'required|exists:userstatus,userstatus_id'
    ], $messages);
  }
  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function deleteValidator(array $data)
  {
      $messages = [
          'regex'    => 'The :attribute complexity is not acceptable.'
      ];

    return Validator::make($data, [
      'password' => 'required|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).{8,}$/'
    ], $messages);
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
    $user->usertype = $data['usertype'];
    $user->status = $data['userstatus'];

    $user->save();

    return $user;
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
      'password' => Hash::make($data['password']),
      'usertype' => $data['usertype'],
      'status' => $data['userstatus']
    ]);
    return $user;
  }
  /**
   * Show the user add view.
   *
   * @return \Illuminate\Http\Response
   */
  public function add()
  {
    $usertypes = Usertype::orderBy('no', 'asc')->get();
    $userstatus = Userstatus::orderBy('no', 'asc')->get();
    return view('user.add', ['usertypes' => $usertypes, 'userstatus' => $userstatus]);
  }
  /**
   * Show the user add view.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleAdd(Request $request)
  {
    $this->validator($request->all())->validate();
    $user = $this->create($request->all());
    $this->notifyUserCreate($user);
    return redirect()->route('user_show', $user->id)->with('status', 'User successfully created.');
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
    if($user->usertype == 'USRTYPE003' && $user->id != Auth::user()->id)
    {
      return redirect()->route('user_show', $user->id)->with('warning', 'You\'re unauthorized for this request.'); 
    }
    $usertypes = Usertype::orderBy('no', 'asc')->get();
    $userstatus = Userstatus::orderBy('no', 'asc')->get();
    return view('user.update', ['user' => User::findOrFail($id), 'usertypes' => $usertypes, 'userstatus' => $userstatus]);
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
      if($user->usertype == 'USRTYPE003' && $user->id != Auth::user()->id)
      {
        return redirect()->route('user_show', $user->id)->with('warning', 'You\'re unauthorized for this request.'); 
      }
      $this->updateValidator($id, $request->all())->validate();
      $this->edit($id, $request->all());
      $this->notifyUserUpdate($user);
    return redirect()->route('user_show', $user->id)->with('status', 'User successfully updated.');
  }
  /**
   * Show the user delete view.
   *
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $id = $this->is_digit($id);
    $user = User::findOrFail($id);
    if($user->usertype == 'USRTYPE003')
    {
      return redirect()->route('user_show', $user->id)->with('warning', 'You\'re unauthorized for this request.'); 
    }
    return view('user.delete', ['user' => User::findOrFail($id)]);
  }
  /**
   * Handle the user update.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleDelete($id, Request $request)
  {
    $id = $this->is_digit($id);
    $user = User::findOrFail($id);
      if($user->usertype == 'USRTYPE003')
      {
        return redirect()->route('user_show', $user->id)->with('warning', 'You\'re unauthorized for that request.'); 
      }
      $this->deleteValidator($request->all())->validate();
      if (Hash::check($request['password'], Auth::user()->password)) {
        $user->delete();
        $this->notifyUserDelete($user);
        return redirect()->route('user')->with('status', 'User successfully deleted.');
      }
      else {
        return back()->withErrors(['password' => 'I did\'nt recognize your password.']);
      }
  }
  /**
   * Show the user update view.
   *
   * @return \Illuminate\Http\Response
   */
  public function changePassword($id)
  {
    $id = $this->is_digit($id);
    $user = User::findOrFail($id);
    if($user->usertype == 'USRTYPE003' && $user->id != Auth::user()->id)
    {
      return redirect()->route('user_show', $user->id)->with('warning', 'You\'re unauthorized for that request.'); 
    }
    return view('user.pwd_change', ['user' => User::findOrFail($id)]);
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
      if($user->usertype == 'USRTYPE003' && $user->id != Auth::user()->id)
      {
        return redirect()->route('user_show', $user->id)->with('warning', 'You\'re unauthorized for that request.'); 
      }
      $this->pwdChangeValidator($request->all())->validate();
        $user->password = Hash::make($request['password_new']);
        $user->save();
        $this->notifyUserChangePassword($user);
        return redirect()->route('user_show', $user->id)->with('status', 'User password changed successfully.');
  }
  protected function notifyUserUpdate(User $user)
  {
      $url = route('user_show', $user->id);
      $receiver = User::find(Auth::user()->id);
      $receiver->notify(new Updated($user, $url));
  }
  protected function notifyUserCreate(User $user)
  {
      $url = route('user_show', $user->id);
      $receiver = User::find(Auth::user()->id);
      $receiver->notify(new Created($user, $url));
  }
  protected function notifyUserChangePassword(User $user)
  {
      $url = route('user_show', $user->id);
      $receiver = User::find(Auth::user()->id);
      $receiver->notify(new ChangePassword($user, $url));
  }
  protected function notifyUserDelete(User $user)
  {
      $url = route('user_show', $user->id);
      $receiver = User::find(Auth::user()->id);
      $receiver->notify(new Deleted($user));
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
}
