<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Usertype;

class UsertypeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin');
  }
  /**
   * Show the Usertype list.
   *
   * @return \Illuminate\Http\Response
   */
  public function list()
  {
    $usertypes = Usertype::orderBy('no', 'asc')->paginate(10);
    return view('usertype.list', compact('usertypes'));
  }
  /**
   * Show the Usertype $course.
   * @param App\Usertype $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    $id = $this->is_digit($id);
    return view('usertype.show', ['usertype' => Usertype::findOrFail($id)]);
  }
  /**
   * Show the course $course edit.
   * @param App\Userstatus $id
   * @return \Illuminate\Http\Response
   */
  public function update($id)
  {
    $id = $this->is_digit($id);
    return view('usertype.update', ['usertype' => Usertype::findOrFail($id)]);
  }
  /**
   * Get a validator for an incoming Usertype update request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'description' => 'string|max:255|unique:userstatus',
      'id' => 'required|integer|exists:usertypes,no'
    ]);
  }
  /**
   * Update the App\Usertype $id.
   * @param App\Usertype $id
   * @param \Illuminate\Http\Request
   * @return \Illuminate\Http\Response
   */
  public function handleUpdate($id, Request $request)
  {
    $this->validator($request->all())->validate();
    $usertype = Usertype::findOrFail($request['id']);
    $usertype->description = $request['description'];
    $usertype->save();
    return redirect()->route('usertype_show', $request['id'])->with('status', 'Usertype successfully updated.');
  }
  /**
   * Check Usertype $id as digit.
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
