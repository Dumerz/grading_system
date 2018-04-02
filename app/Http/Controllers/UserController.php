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
        $users = User::paginate(10);
        return view('user.list', compact('users'));
    }

    /**
     * Show the users list.
     * @param App\User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $user;
    }
    /**
     * Show the user add view.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        return view('user.add');
    }


    /**
     * Show the user update view.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        return view('user.update');
    }


    /**
     * Show the user delete view.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete()
    {
        return view('user.delete');
    }
}
