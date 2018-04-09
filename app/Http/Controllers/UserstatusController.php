<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Userstatus;

class UserstatusController extends Controller
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
     * Show the Userstatus list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $userstatus = Userstatus::orderBy('no', 'asc')->paginate(10);
        return view('userstatus.list', compact('userstatus'));
    }
    /**
     * Show the Userstatus $id.
     * @param App\Userstatus $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $this->is_digit($id);
        return view('userstatus.show', ['userstatus' => Userstatus::findOrFail($id)]);
    }
    /**
     * Update the current Userstatus $id.
     * @param Userstatus $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $id = $this->is_digit($id);
        return view('userstatus.update', ['userstatus' => Userstatus::findOrFail($id)]);
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
            'description' => 'string|required|max:255|unique:userstatus',
            'id' => 'required|integer|exists:userstatus,no'
        ]);
    }
    /**
     * Show the course $course edit.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate($id, Request $request)
    {
        $this->validator($request->all())->validate();
        $userstatus = Userstatus::findOrFail($request['id']);
        $userstatus->description = Str::upper($request['description']);
        $userstatus->save();
        return redirect()->route('userstatus_show', $request['id'])->with('status', 'Userstatus successfully updated.');
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
