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
    // /**
    //  * Show the course $course.
    //  * @param App\Course
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id, $period)
    // {
    //   $id = $this->is_digit($id);
    //   $course = Course::findOrFail($id);      
    //   if ($course->evaluator == Auth::user()->id) {
    //     $period = $this->is_digit($period);
    //     $periods = Courseperiod::findOrFail($period);
    //       if ($periods->course == $course->id) {
    //         return view('courseperiod.show', ['course' => $course, 'period' => $periods]);
    //       }
    //       else {
    //         abort(404);
    //       }
    //   }
    //   else {
    //     return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
    //   }
    // }
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
    // /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    // protected function updateValidator(array $data)
    // {

    //   return Validator::make($data, [
    //     'description' => 'required|max:255|string'
    //   ]);
    // }
    // /**
    //  * Get a validator for an incoming registration request.
    //  *
    //  * @param  array  $data
    //  * @return \Illuminate\Contracts\Validation\Validator
    //  */
    // protected function deleteValidator(array $data)
    // {
    //     $messages = [
    //         'regex'    => 'The :attribute complexity is not acceptable.'
    //     ];

    //   return Validator::make($data, [
    //     'password' => 'required|min:8|regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#\$%\^&\*]).{8,}$/'
    //   ], $messages);
    // }
    // /**
    //  * Show the course $course.
    //  * @param App\Course
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update($id, $period)
    // {
    //   $id = $this->is_digit($id);
    //   $course = Course::findOrFail($id);      
    //   if ($course->evaluator == Auth::user()->id) {
    //     $period = $this->is_digit($period);
    //     $periods = Courseperiod::findOrFail($period);
    //       if ($periods->course == $course->id) {
    //         return view('courseperiod.update', ['course' => $course, 'period' => $periods]);
    //       }
    //       else {
    //         abort(404);
    //       }
    //   }
    //   else {
    //     return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
    //   }
    // }
    // /**
    //  * Show the course $course.
    //  * @param App\Course
    //  * @return \Illuminate\Http\Response
    //  */
    // protected function edit($id, array $data)
    // {
    //   $period = Courseperiod::find($id);
    //   $period->description = Str::ucfirst($data['description']);

    //   $period->save();

    //   return $period;
    // }
    // /**
    //  * Show the course $course.
    //  * @param App\Course
    //  * @return \Illuminate\Http\Response
    //  */
    // public function handleUpdate($id, $period, Request $request)
    // {
    //   $id = $this->is_digit($id);
    //   $course = Course::findOrFail($id);      
    //   if ($course->evaluator == Auth::user()->id) {
    //     $period = $this->is_digit($period);
    //     $periods = Courseperiod::findOrFail($period);
    //       if ($periods->course == $course->id) {
    //         $this->updateValidator($request->all())->validate();
    //         $periods = $this->edit($period, $request->all());
    //         return redirect()->route('course_managed_period_show', ['course' => $course->id, 'period' => $periods->id])->with('status', 'Course period successfully updated.');
    //       }
    //       else {
    //         abort(404);
    //       }
    //   }
    //   else {
    //     return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
    //   }
    // }
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
        $periods = Courseperiod::where('course', 1)->where('id', 1)->count();
          if ($periods == 1) {
            $this->deleteValidator($request->all())->validate();
            if (Hash::check($request['password'], Auth::user()->password)) {
              try {
                $periods->delete();
              } catch (QueryException $e) {
                return back()->with('warning', 'Unable to delete period because it is still referenced from another table.');
              }
              return redirect()->route('course_managed_period', $course->id)->with('status', 'Period successfully deleted.');
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
    // /**
    //  * Show the course $course.
    //  * @param App\Course
    //  * @return \Illuminate\Http\Response
    //  */
    public function add($id, $period)
    {
      $id = $this->is_digit($id);
      $period = $this->is_digit($period);
      return view('courseperioditem.add', ['course' => Course::findOrFail($id), 'period' => Courseperiod::findOrFail($id), 'schemes' => Coursescheme::where('course',$id)->get()]);
    }
 //    /**
 //     * Show the users list.
 //     *
 //     * @return \Illuminate\Http\Response
 //     */
 //    public function list($id)
 //    {
 //      $id = $this->is_digit($id);
 //      $course = Course::findOrFail($id);
 //      if ($course->evaluator == Auth::user()->id) {
 //        return view('courseperiod.list', ['course' => $course, 'periods' => Courseperiod::where('course', $id)->paginate(10)]);
 //      }
 //      else {
 //        return redirect()->route('course_managed')->with('warning', 'Whoops! You\'re unauthorized to access that page!');
 //      }

 //    }
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
            return $item;
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
	// /**
	// * Check Userstatus $id as digit.
	// * @param App\Usertype $id
	// * @param mixed $entry
	// * @return mixed $entry
	// */
	protected function is_digit($entry)
	{
	  if (!ctype_digit($entry)) {
	    $entry = -1;
	  }
	  return (int)$entry;
	}
}
