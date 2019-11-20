<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Log;
use App\Post;
use App\User;
use App\Show;

class AdminsController extends Controller
{
    public function index()
    {
        $users = User::all()->count();
        $shows = Show::all()->count();
        $posts = Post::all()->count();
        $admins = 1;

        $data = array(
            'posts' => $posts,
            'shows' => $shows,
            'users' => $users,
            'admins' => $admins
        );
        return view('admin.home')->with($data);
    }
    public function logs()
    {
        $logs = Log::orderBy('created_at','desc')->paginate(15);
        return view('admin.logs')->with('logs',$logs);
    }
}
