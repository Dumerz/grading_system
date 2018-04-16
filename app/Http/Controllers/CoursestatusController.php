<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coursestatus;

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
    	$this->middleware('admin');
    }
    /**
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $coursestatus = Coursestatus::paginate(10);
        return view('coursestatus.list', compact('coursestatus'));
    }
}
