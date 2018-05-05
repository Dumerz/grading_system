<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Course;
use App\Coursestudent;
use App\User;

class CourseStudentController extends Controller
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
        $this->middleware('manage_course');
    }
	/**
	* Show the user add view.
	*
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
    $id = $this->is_digit($id);
		$students = Coursestudent::where('course', $id)->orderBy('id', 'asc')->paginate(10);
		return view('coursestudent.list', ['course' => Course::findOrFail($id), 'students' => $students]);
	}
    /**
    * Show the user add view.
    *
    * @return \Illuminate\Http\Response
    */
    public function add($id)
    {
        $id = $this->is_digit($id);
        $students = User::where('usertype', 'USRTYPE001')->orderBy('name_last', 'asc')->orderBy('name_first', 'asc')->orderBy('name_last', 'asc')->orderBy('name_suffix', 'asc')->get();
        $posStudent = collect(New User);
        foreach ($students as $student) {
          $enrolled = Coursestudent::where('course', $id)->where('student', $student->id)->count();
          if($enrolled < 1){
            $posStudent->push($student);
          }
        }
        //$students
        return view('coursestudent.add', ['course' => $id, 'students' => $posStudent]);
    }
    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function addValidator(array $data)
    {
        return Validator::make($data, [
            'id' => 'required|array',
            'id.*' => 'required|numeric|exists:users,id'
        ]);
    }
    /**
    * Get a validator for an incoming registration request.
    *
    * @param  array  $data
    * @return \Illuminate\Contracts\Validation\Validator
    */
    protected function removeValidator(array $data)
    {
        return Validator::make($data, [
            'id' => 'required|array',
            'id.*' => 'required|numeric|exists:coursestudents,id'
        ]);
    }
    /**
    * Show the user add view.
    *
    * @return \Illuminate\Http\Response
    */
    public function handleAdd($id, Request $request)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);
      if ($course->evaluator == Auth::user()->id) {
        $this->addValidator($request->all())->validate();
          $this->create($id, $request->all());
          return redirect()->route('course_managed_student', $course->id)->with('status', 'Students successfully enrolled.');
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized for that request!');
      }
    }
    /**
    * Show the user add view.
    *
    * @return \Illuminate\Http\Response
    */
    public function handleRemove($id, Request $request)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);
      if ($course->evaluator == Auth::user()->id) {
        $this->removeValidator($request->all())->validate();
        try {
          $this->delete($id, $request->all());
        } catch (QueryException $e) {
          return back()->with('warning', 'Unable to unenroll user because it is still referenced from another table.');
        }
          return redirect()->route('course_managed_student', $course->id)->with('status', 'Students successfully unenrolled.');
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized for that request!');
      }
    }
    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */
    protected function create($id, array $data)
    {
        foreach ($data['id'] as $stud) {
          $student = Coursestudent::where('course', $id)->where('student', $stud);
            if($stud < 1){
              $student = Coursestudent::create([
                'student' => $stud,
                'course' => $id,
                'status' => 'CSSTUDSTAT001'
              ]);
            }
        }
        //return $schemes;
    }
    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */
    protected function delete($id, array $data)
    {
        foreach ($data['id'] as $stud) {
            $student = Coursestudent::where('course', $id)->where('id', $stud);
            $student->delete();
        }
        //return $schemes;
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
