<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Coursestatus;
use App\User;
use App\Notifications\Coursestatus\Updated;

class CoursestatusController extends Controller
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
        $coursestatus = Coursestatus::orderBy('no', 'asc')->paginate(10);
        return view('coursestatus.list', compact('coursestatus'));
    }
    /**
     * Show the Userstatus $id.
     * @param App\Userstatus $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = $this->is_digit($id);
        return view('coursestatus.show', ['coursestatus' => Coursestatus::findOrFail($id)]);
        //return Coursestatus::findOrFail($id);
    }
    /**
     * Update the current Userstatus $id.
     * @param Userstatus $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $id = $this->is_digit($id);
        return view('coursestatus.update', ['coursestatus' => Coursestatus::findOrFail($id)]);
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
            'description' => 'string|required|max:255|unique:coursestatus,description',
            'id' => 'required|integer|exists:coursestatus,no'
        ]);
    }
    /**
     * Show the course $course edit.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate($id, Request $request)
    {
        $request['description'] = Str::upper($request['description']);
        $this->validator($request->all())->validate();
        $coursestatus = Coursestatus::findOrFail($request['id']);
        $coursestatus->description = Str::upper($request['description']);
        $coursestatus->save();
        $this->notifyUser($coursestatus);
        return redirect()->route('course_status_show', $request['id'])->with('status', 'Coursestatus successfully updated.');
    }
    protected function notifyUser(Coursestatus $coursestatus)
    {
        $url = route('course_status_show', $coursestatus->no);
        $user = User::find(Auth::user()->id);
        $user->notify(new Updated($url));
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
