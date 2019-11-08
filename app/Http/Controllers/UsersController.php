<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name','asc')->paginate(10);
        return view('users.index')->with('users',$users);
    }
    public function search()
    {
        $search = $_GET['search'];
        $users = User::where('name',$search)->orWhere('name','like',$search.'%')->orderBy('name','asc')->paginate(10);
        return view('users.index')->with('users',$users);
    }
}
