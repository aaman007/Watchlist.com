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
        $admins = User::where('role','Admin')->count();

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
    public function showPosts()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(15);
        return view('admin.posts_list')->with('posts',$posts);
    }
    public function showAdmins()
    {
        $admins = User::where('Role','Admin')->orderBy('name','asc')->paginate(15);
        return view('admin.admins_list')->with('admins',$admins);
    }
    public function showUsers()
    {
        $users = User::orderBy('name','asc')->paginate(15);
        return view('admin.users_list')->with('users',$users);
    }
    public function showShows()
    {
        $shows = Show::orderBy('created_at','desc')->paginate(15);
        return view('admin.shows_list')->with('shows',$shows);
    }
    public function getTitleByRank($rank)
    {
        if($rank == 1)
            return "Omni King";
        else if($rank == 2)
            return "Supreme Commander";
        else if($rank == 3)
            return "Rookie";
        else
            return "Filthy Casual";
    }
    public function getNextLowerRank($rank)
    {
        if($rank == 100)
            return 100;
        if($rank < 3)
            return $rank+1;
        return 100;
    }
    public function getNextUpperRank($rank)
    {
        if($rank == 1)
            return 1;
        if($rank <= 3)
            return $rank-1;
        return 3;
    }
    public function getUserRole($rank)
    {
        if($rank <= 3)
            return "Admin";
        return "User";
    }
    public function promote($id)
    {
        $user = User::find($id);
        $user->rank = self::getNextUpperRank($user->rank);
        $user->title = self::getTitleByRank($user->rank);
        $user->role = self::getUserRole($user->rank);
        $user->save();

        // Adding Log
        $log = new Log;
        $log->details = $user->name . " was promoted by " . auth()->user()->name;
        $log->save();

        return redirect('/admin-panel/users')->with('success','User Promoted Successfully');
    }
    public function demote($id)
    {
        $user = User::find($id);
        $user->rank = self::getNextLowerRank($user->rank);
        $user->title = self::getTitleByRank($user->rank);
        $user->role = self::getUserRole($user->rank);
        $user->save();

        // Adding Log
        $log = new Log;
        $log->details = $user->name . " was demoted by " . auth()->user()->name;
        $log->save();

        return redirect('/admin-panel/users')->with('success','User Demoted Successfully');
    }
}
