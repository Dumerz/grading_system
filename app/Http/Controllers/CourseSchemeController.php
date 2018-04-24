<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Course;
use App\Coursescheme;

class CourseSchemeController extends Controller
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
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function show($id, $scheme)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);      
      if ($course->evaluator == Auth::user()->id) {
        $scheme = $this->is_digit($scheme);
        $schemes = Coursescheme::findOrFail($scheme);
          if ($schemes->course == $course->id) {
            return view('coursescheme.show', ['course' => $course, 'scheme' => $schemes]);
          }
          else {
            abort(404);
          }
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
      }
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function delete($id, $scheme)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);     
      if ($course->evaluator == Auth::user()->id) {
        $scheme = $this->is_digit($scheme);
        $schemes = Coursescheme::findOrFail($scheme);
          if ($schemes->course == $course->id) {
            return view('coursescheme.delete', ['course' => $course, 'scheme' => $schemes]);
          }
          else {
            abort(404);
          }
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
    protected function updateValidator(array $data)
    {

      return Validator::make($data, [
        'description' => 'required|max:255|string'
      ]);
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
    public function update($id, $scheme)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);      
      if ($course->evaluator == Auth::user()->id) {
        $scheme = $this->is_digit($scheme);
        $schemes = Coursescheme::findOrFail($scheme);
          if ($schemes->course == $course->id) {
            return view('coursescheme.update', ['course' => $course, 'scheme' => $schemes]);
          }
          else {
            abort(404);
          }
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
      }
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    protected function edit($id, array $data)
    {
      $scheme = Coursescheme::find($id);
      $scheme->description = Str::ucfirst($data['description']);

      $scheme->save();

      return $scheme;
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate($id, $scheme, Request $request)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);      
      if ($course->evaluator == Auth::user()->id) {
        $scheme = $this->is_digit($scheme);
        $schemes = Coursescheme::findOrFail($scheme);
          if ($schemes->course == $course->id) {
            $this->updateValidator($request->all())->validate();
            $count = Coursescheme::where('course', $id)->where('description', ucfirst($request['description']))->count();
            if ($count = 0) {
              $schemes = $this->edit($scheme, $request->all());
              return redirect()->route('course_managed_scheme_show', ['course' => $course->id, 'scheme' => $schemes->id])->with('status', 'Course scheme successfully updated.');
            }
            else {
              return back()->withErrors(['description' => 'Desciption must be unique.']);
            }
          }
          else {
            abort(404);
          }
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
      }
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function handleDelete($id, $scheme, Request $request)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);      
      if ($course->evaluator == Auth::user()->id) {
        $scheme = $this->is_digit($scheme);
        $schemes = Coursescheme::findOrFail($scheme);
          if ($schemes->course == $course->id) {
            $this->deleteValidator($request->all())->validate();
            if (Hash::check($request['password'], Auth::user()->password)) {
              try {
                $schemes->delete();
              } catch (QueryException $e) {
                return back()->with('warning', 'Unable to delete scheme because it is still referenced from another table.');
              }
              return redirect()->route('course_managed_scheme', $course->id)->with('status', 'Scheme successfully deleted.');
            }
            else {
              return back()->withErrors(['password' => 'I did\'nt recognize your password.']);
            }
          }
          else {
            abort(404);
          }
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
      }
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function add($id)
    {
      $id = $this->is_digit($id);
      return view('coursescheme.add', ['course' => Course::findOrFail($id)]);
    }
    /**
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);
      if ($course->evaluator == Auth::user()->id) {
        return view('coursescheme.list', ['course' => $course, 'schemes' => Coursescheme::where('course', $id)->paginate(10)]);
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
      }

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
        $count = Coursescheme::where('course', $id)->where('description', ucfirst($request['description']))->count();
        if ($count < 1) {
          $scheme = $this->create($id, $request->all());
          return redirect()->route('course_managed_scheme', $scheme->course)->with('status', 'Scheme successfully created.');
        }
        else {
          return back()->withErrors(['description' => 'Description must be unique.']);
        }
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized for that request!');
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
          'description' => 'required|max:255|string'
        ]);
      }
    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array  $data
    * @return \App\User
    */
    protected function create($id, array $data)
    {
        $schemes = Coursescheme::create([
          'description' => Str::ucfirst($data['description']),
          'course' => $id,
          'amount' => 0.25
        ]);
        return $schemes;
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
