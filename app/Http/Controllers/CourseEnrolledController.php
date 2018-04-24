<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Course;
use App\Coursestudent;
use App\User;

class CourseEnrolledController extends Controller
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
        //$this->middleware('manage_course');
    }
	/**
	* Show the user add view.
	*
	* @return \Illuminate\Http\Response
	*/
	public function list()
	{
		$id = Auth::user()->id;
    $courses = Coursestudent::where('student', $id)->orderBy('id', 'asc')->paginate(10);
		return view('courseenrolled.list', ['courses' => $courses]);
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
