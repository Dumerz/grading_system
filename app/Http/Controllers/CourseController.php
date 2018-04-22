<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Course;
use App\Coursestatus;
use App\User;

class CourseController extends Controller
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
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function addValidator(array $data)
  {

    return Validator::make($data, [
      'name' => 'required|string|max:255|min:6|unique:courses,name',
      'description' => 'required|max:255|string',
      'status' => 'required|exists:coursestatus,coursestatus_id'
    ]);
  }
  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  protected function updateValidator(Course $course, array $data)
  {

    return Validator::make($data, [
      'name' => 'required|string|max:255|min:6|unique:courses,name,'.$course->name,
      'description' => 'required|max:255|string',
      'status' => 'required|exists:coursestatus,coursestatus_id'
    ]);
  }
    /**
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $courses = Course::paginate(10);
        return view('course.list', compact('courses'));
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $id = $this->is_digit($id);
      return view('course.show', ['course' => Course::findOrFail($id)]);
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
      $id = $this->is_digit($id);
      $coursestatus = Coursestatus::all();
      return view('course.update', ['course' => Course::findOrFail($id), 'coursestatus' => $coursestatus]);
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
      $id = $this->is_digit($id);
      return view('course.delete', ['course' => Course::findOrFail($id)]);
    }
  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  protected function create(array $data)
  {
    $course = Course::create([
      'name' => Str::title($data['name']),
      'description' => Str::title($data['description']),
      'evaluator' => $data['evaluator'],
      'status' => $data['status']
    ]);
    return $course;
  }
  /**
   * Show the user add view.
   *
   * @return \Illuminate\Http\Response
   */
  public function add()
  {
    $evaluators = User::where('usertype', 'USRTYPE002')->orWhere('usertype', 'USRTYPE003')->orderBy('name_last', 'asc')->orderBy('name_first', 'asc')->orderBy('name_suffix', 'asc')->get();
    $coursestatus = Coursestatus::all();
    return view('course.add', ['evaluators' => $evaluators, 'coursestatus' => $coursestatus]);
  }
  /**
   * Show the user add view.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleAdd(Request $request)
  {
    $this->addValidator($request->all())->validate();
    $course = $this->create($request->all());
    //$this->notifyUserCreate($user);
    return redirect()->route('course_show', $course->id)->with('status', 'Course successfully created.');
  }
  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\User
   */
  protected function edit($id, array $data)
  {
    $course = Course::find($id);
    $course->name = Str::title($data['name']);
    $course->description = Str::title($data['description']);
    $course->status = $data['status'];

    $course->save();

    return $course;
  }
  /**
   * Handle the user update.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleUpdate($id, Request $request)
  {
    $id = $this->is_digit($id);
    $course = Course::findOrFail($id);
      $this->updateValidator($course, $request->all())->validate();
      $this->edit($id, $request->all());
      //$this->notifyUserUpdate($user);
    return redirect()->route('course_show', $course->no)->with('status', 'Course successfully updated.');
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
