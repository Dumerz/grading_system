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
      'evaluator' => 'required|exists:users,id',
      'status' => 'required|exists:coursestatus,coursestatus_id'
    ]);
  }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('create_course');
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
    public function show(Course $course)
    {
        return $course;
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
}
