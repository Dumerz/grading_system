<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usertype;

class UsertypeController extends Controller
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
     * Show the usertype list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $usertypes = Usertype::paginate(10);
        return view('usertype.list', compact('usertypes'));
    }
    /**
     * Show the course $course.
     * @param App\Course
     * @return \Illuminate\Http\Response
     */
    public function show(Usertype $usertype)
    {
        return $usertype;
    }
}
