<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use App\Course;
use App\Coursestatus;
use App\User;
use App\Notifications\Course\Updated;
use App\Notifications\Course\Deleted;
use App\Notifications\Course\Created;

class CourseTeachingController extends Controller
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
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $evaluator = Auth::user()->id;
        $courses = Course::where('evaluator',$evaluator)->paginate(10);
        return view('coursemanaged.list', compact('courses'));
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);
      if ($course->evaluator == Auth::user()->id) {
        return view('coursemanaged.show', ['course' => $course]);
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
      }
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
    * Show the user add view.
    *
    * @return \Illuminate\Http\Response
    */
    public function add()
    {
        $coursestatus = Coursestatus::all();
        return view('coursemanaged.add', ['coursestatus' => $coursestatus]);
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
    $this->notifyCourseCreate($course);
    return redirect()->route('course_managed_show', $course->id)->with('status', 'Course successfully created.');
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
      'name' => Str::ucfirst($data['name']),
      'description' => Str::ucfirst($data['description']),
      'evaluator' => Auth::user()->id,
      'status' => $data['status']
    ]);
    return $course;
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
      'description' => 'required|max:255|string',
      'status' => 'required|exists:coursestatus,coursestatus_id',
      'name' => [
          'required','string','max:255','min:6',
          Rule::unique('courses')->ignore($course->name, 'name')]
    ]);
  }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);
      if ($course->evaluator == Auth::user()->id) {
        $coursestatus = Coursestatus::all();
        return view('coursemanaged.update', ['course' => Course::findOrFail($id), 'coursestatus' => $coursestatus]);
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
      }
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
    if ($course->evaluator == Auth::user()->id) {
      $this->updateValidator($course, $request->all())->validate();
      $course = $this->edit($id, $request->all());
      $this->notifyCourseUpdate($course);
      return redirect()->route('course_managed_show', $course->id)->with('status', 'Course successfully updated.');
    }
    else {
      return redirect()->route('course_managed_show', $course->id)->with('warning', 'Whoops! You\'re unauthorized for that request!');
    }
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
    $course->name = Str::ucfirst($data['name']);
    $course->description = Str::ucfirst($data['description']);
    $course->status = $data['status'];

    $course->save();

    return $course;
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
   * Show the course $course.
   * @param App\Course
   * @return \Illuminate\Http\Response
   */
  public function delete($id)
  {
    $id = $this->is_digit($id);
    $course = Course::findOrFail($id);
    if ($course->evaluator == Auth::user()->id) {
      return view('coursemanaged.delete', ['course' => Course::findOrFail($id)]);
    }
    else {
      return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
    }
  }
  /**
   * Handle the user update.
   *
   * @return \Illuminate\Http\Response
   */
  public function handleDelete($id, Request $request)
  {
    $id = $this->is_digit($id);
    $course = Course::findOrFail($id);
    if ($course->evaluator == Auth::user()->id) {
      $this->deleteValidator($request->all())->validate();
        if (Hash::check($request['password'], Auth::user()->password)) {
          try {
            $course->delete();
          } catch (QueryException $e) {
            return back()->with('warning', 'Unable to delete course because it is still referenced from another table.');
          }
          $this->notifyCourseDelete($course);
          return redirect()->route('course_managed')->with('status', 'Course successfully deleted.');
        }
        else {
          return back()->withErrors(['password' => 'I did\'nt recognize your password.']);
        }
    }
    else {
      return redirect()->route('course_managed_show', $course->id)->with('warning', 'Whoops! You\'re unauthorized for that request!');
    }
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
    protected function notifyCourseCreate(Course $course)
    {
        $url = route('course_managed_show', $course->id);
        $receiver = User::find(Auth::user()->id);
        $receiver->notify(new Created($course, $url));
    }
    protected function notifyCourseUpdate(Course $course)
    {
        $url = route('course_managed_show', $course->id);
        $receiver = User::find(Auth::user()->id);
        $receiver->notify(new Updated($course, $url));
    }
    protected function notifyCourseDelete(Course $course)
    {
        $url = route('course_managed_show', $course->id);
        $receiver = User::find(Auth::user()->id);
        $receiver->notify(new Deleted($course));
    }
}
