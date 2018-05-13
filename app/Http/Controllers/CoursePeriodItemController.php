<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use App\Course;
use App\Courseperiod;
use App\Coursescheme;
use App\Courseitem;
use App\Coursestudent;
use App\Courseevaluation;

class CoursePeriodItemController extends Controller
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
    public function show($id, $period, $item)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);     
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('course', $id)->where('id', $period)->count();
          if($periods == 1) {
            $item =  $this->is_digit($item);
            $items = Courseitem::where('period', $period)->where('id', $item)->count();
              if($items == 1){
                return view('courseperioditem.show', ['item' => Courseitem::find($item)]);
              }
              else {
                abort(404);
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
    public function delete($id, $period, $item)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);     
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('course', $id)->where('id', $period)->count();
          if($periods == 1) {
            $item =  $this->is_digit($item);
            $items = Courseitem::where('period', $period)->where('id', $item)->count();
              if($items == 1){
                return view('courseperioditem.delete', ['item' => Courseitem::find($item)]);
              }
              else {
                abort(404);
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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function updateValidator(array $data)
    {

      return Validator::make($data, [
        'description' => 'required|max:255|string',
        'scheme' => 'required|max:255|exists:courseschemes,id'
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
    public function update($id, $period, $item)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);      
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('course', $id)->where('id', $period)->count();
          if($periods == 1) {
            $item =  $this->is_digit($item);
            $items = Courseitem::where('period', $periods)->where('id', $item)->count();
              if($items == 1){
                return view('courseperioditem.update', ['item' => Courseitem::find($item), 'schemes' => Coursescheme::where('course',$id)->get()]);
              }
              else {
                abort(404);
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
    protected function edit($id, array $data)
    {
      $item = Courseitem::find($id);
      $item->description = Str::ucfirst($data['description']);
      $item->scheme = $data['scheme'];
      $item->save();

      return $item;
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function handleUpdate($id, $period, $item, Request $request)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);      
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('course', $id)->where('id', $period)->count();
          if ($periods == 1) {
            $item =  $this->is_digit($item);
            $items = Courseitem::where('period', $period)->where('id', $item)->count();
              if($items == 1){
                $this->updateValidator($request->all())->validate();
                $items = $this->edit($item, $request->all());
                return redirect()->route('course_managed_period_item_show', ['course' => $id, 'period' => $period, 'item' => $item])->with('status', 'New item successfully created!');
              }
              else {
                abort(404);
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
    public function handleDelete($id, $period, $item, Request $request)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);      
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('course', $id)->where('id', $period)->count();
          if ($periods == 1) {
            $item =  $this->is_digit($item);
            $items = Courseitem::where('period', $period)->where('id', $item)->count();
              if($items == 1){
                $this->deleteValidator($request->all())->validate();
                if (Hash::check($request['password'], Auth::user()->password)) {
                    try {
                        $items = Courseitem::find($item);
                        $items->delete();
                        return 'Success';
                    } catch (QueryException $e) {
                        return back()->with('warning', 'Unable to delete item because it is still referenced from another table.');
                    }
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
            abort(404);
          }
      }
      else {
        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
      }
    }
    // /**
    //  * Show the course $course.
    //  * @param App\Course
    //  * @return \Illuminate\Http\Response
    //  */
    public function add($id, $period)
    {
      $id = $this->is_digit($id);
      $period = $this->is_digit($period);
      return view('courseperioditem.add', ['course' => Course::findOrFail($id), 'period' => Courseperiod::findOrFail($period), 'schemes' => Coursescheme::where('course',$id)->get()]);
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
        return view('courseperioditem.list', ['course' => $course, 'periods' => Courseperiod::where('course', $id)->orderBy('id', 'asc')->get(), 'items' => Courseitem::where('course', $id)->orderBy('scheme', 'asc')->get()]);
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
	public function handleAdd($id, $period, Request $request)
	{
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('id', $period)->where('course', $id)->count();
        if ($periods == 1) {
          $this->addValidator($request->all())->validate();
          $items = Courseitem::where('period', $period)->where('course', $id)->where('description', $request['description'])->count();
          if($items < 1) {
            $item = $this->create($id, $period, $request->all());
            return redirect()->route('course_managed_period_item_show', ['course' => $id, 'period' => $period, 'item' => $item->id])->with('status', 'New item successfully created!');
          }
          else {
            return back()->withErrors(['description' => 'Description should be unique.'])->withInput();
          }
        }
        else {
          abort(404);
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
	      'description' => 'required|max:255|string',
        'max_score' => 'required|min:1|numeric',
        'scheme' => 'required|max:255|exists:courseschemes,id'
	    ]);
	  }
	/**
	* Create a new user instance after a valid registration.
	*
	* @param  array  $data
	* @return \App\User
	*/
	protected function create($id, $period, array $data)
	{
		$item = Courseitem::create([
		  'description' => Str::ucfirst($data['description']),
      'period' => $period,
      'scheme' => $data['scheme'],
      'max_score' => $data['max_score'],
		  'course' => $id
		]);
		return $item;
	}
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function grade($id, $period, $item)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);     
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('course', $id)->where('id', $period)->count();
          if($periods == 1) {
            $item =  $this->is_digit($item);
            $items = Courseitem::where('period', $period)->where('id', $item);
              if($items->count() == 1){
                $students = Coursestudent::where('course', $id)->orderBy('id', 'asc')->paginate(10);
                $evaluations = Courseevaluation::where('course_item', $item)->get();
                return view('courseperioditem.grade', ['item' => Courseitem::find($item), 'students' => $students, 'evaluations' => $evaluations]);
              }
              else {
                abort(404);
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
    public function grader($id, $period, $item)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);     
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('course', $id)->where('id', $period)->count();
          if($periods == 1) {
            $item =  $this->is_digit($item);
            $items = Courseitem::where('period', $period)->where('id', $item);
              if($items->count() == 1){
                $students = Coursestudent::where('course', $id)->orderBy('id', 'asc')->paginate(1);
                $evaluations = Courseevaluation::where('course_item', $item)->get();
                return view('courseperioditem.grader', ['item' => Courseitem::find($item), 'student' => $students, 'evaluations' => $evaluations]);
              }
              else {
                abort(404);
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
  * Create a new user instance after a valid registration.
  *
  * @param  array  $data
  * @return \App\User
  */
  protected function addNewGrade($item, array $data)
  { //'course_item', 'course_student', 'score'
    $eval = Courseevaluation::create([
      'course_item' => $item,
      'course_student' => $data['student'],
      'score' => $data['score']
    ]);
    return $eval;
  }
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function gradeValidator($max, array $data)
    {

      return Validator::make($data, [
        'student' => 'required|integer|exists:coursestudents,id',
        'score' => 'required|integer|min:0|max:'.$max
      ]);
    }
  /**
   * Show the course $course.
   * @param App\Course
   * @return \Illuminate\Http\Response
   */
  protected function updateGrade($id, array $data)
  {
    $eval = Courseevaluation::find($id);
    $eval->score = $data['score'];
    $eval->save();

    return $eval;
  }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function handleGrader($id, $period, $item, Request $request)
    {
      $id = $this->is_digit($id);
      $course = Course::findOrFail($id);     
      if ($course->evaluator == Auth::user()->id) {
        $period = $this->is_digit($period);
        $periods = Courseperiod::where('course', $id)->where('id', $period)->count();
          if($periods == 1) {
            $item =  $this->is_digit($item);
            $items = Courseitem::where('period', $period)->where('id', $item);
              if($items->count() == 1){
                $student = Coursestudent::where('course', $id)->where('id', $request['student']);
                if($student->count() == 1){
                  $max = $items->first();
                  $this->gradeValidator($max->max_score, $request->all())->validate();
                  $evaluation = Courseevaluation::where('course_item', $item)->where('course_student', $request['student']);
                  if($evaluation->count() == 1){
                    $eval = $evaluation->first();
                    $this->updateGrade($eval->id, $request->all());
                    return back()->with('status', 'Grade successfully updated.');
                  }
                  else {
                    $this->addNewGrade($item, $request->all());
                    return back()->with('status', 'Student successfully graded.');
                  }
                }
                else {
                  abort(404);
                }
              }
              else {
                abort(404);
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
