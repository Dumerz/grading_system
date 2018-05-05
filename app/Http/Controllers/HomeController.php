<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Usertype;
use App\Userstatus;
use App\Course;
use App\Coursestatus;
use App\Coursestudentstatus;

class HomeController extends Controller
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->usertype == 'USRTYPE003'){
            return view('home.admin', ['usercount' => User::all()->count(), 'coursecount' => Course::all()->count(), 'usertypecount' => Usertype::all()->count(), 'userstatuscount' => Userstatus::all()->count(), 'coursemanagedcount' => Course::where('evaluator',Auth::user()->id)->count(), 'coursestatuscount' => Coursestatus::all()->count(), 'coursestudentstatuscount' => Coursestudentstatus::all()->count()]);
        }
        elseif(Auth::user()->usertype == 'USRTYPE002'){
            return view('home.rater', ['coursemanagedcount' => Course::where('evaluator',Auth::user()->id)->count()]);
        }
        elseif(Auth::user()->usertype == 'USRTYPE001'){
            return view('home.ratee');
        }
    }
}
