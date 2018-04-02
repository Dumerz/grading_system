<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userstatus;

class UserstatusController extends Controller
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
     * Show the userstatus list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $userstatus = Userstatus::paginate(1);
        return view('userstatus.list', compact('userstatus'));
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function show(Userstatus $userstatus)
    {
        return $userstatus;
    }
}
