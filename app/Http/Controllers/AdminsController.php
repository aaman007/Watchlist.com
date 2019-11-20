<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminsController extends Controller
{
    public function index()
    {
        $users = 12;
        $announcements = 13;
        $posts = 13;
        $admins = 22;

        $data = array(
            'posts' => $posts,
            'announcements' => $announcements,
            'users' => $users,
            'admins' => $admins
        );
        return view('admin.home')->with($data);
    }
}
