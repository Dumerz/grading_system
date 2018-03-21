<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
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
        return view('user.list');
    }

    /**
     * Show the users list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list_sample()
    {
        $users = User::paginate(5);
        return view('user.listsample', compact('users'));
    }
}
