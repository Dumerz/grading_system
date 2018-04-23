<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Course;
use App\Courseperiods;

class CoursePeriodController extends Controller
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
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $id = $this->is_digit($id);
      return view('courseperiod.show', ['course' => Course::findOrFail($id)]);
    }
    /**
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $id = $this->is_digit($id);
        return view('courseperiods.show', ['course' => Course::findOrFail($id), 'periods' => Courseperiods::where('course', $id)->get()]);

    }
	/**
	* Show the user add view.
	*
	* @return \Illuminate\Http\Response
	*/
	public function handleAdd($id, Request $request)
	{
	    $id = $this->is_digit($id);
		$this->addValidator($request->all())->validate();
		$period = $this->create($id, $request->all());
		return redirect()->route('course_period', $period->course)->with('status', 'Period successfully created.');
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
		$periods = Courseperiods::create([
		  'description' => Str::ucfirst($data['description']),
		  'course' => $id
		]);
		return $periods;
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
