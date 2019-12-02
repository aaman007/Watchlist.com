<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Log;
use App\Post;
use App\User;
use App\Show;
use App\Statistic;

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
    public function getWatchCount($id)
    {
        return Statistic::where('show_id',$id)->where('status','Completed')->count();
    }
    public function getRatingCount($id)
    {
       return Statistic::where('show_id',$id)->where('rating','>',0)->count();
    }
    public function getRatingSum($id)
    {
        return Statistic::where('show_id',$id)->where('rating','!=','')->sum('rating');
    }
    public function viewShow($id)
    {
        try{
            $show = Show::find($id);
            $show->watch_count = self::getWatchCount($id);
            $show->rating_count = self::getRatingCount($id);
            if($show->rating_count)
                $show->rating = self::getRatingSum($id) / (1.0 * $show->rating_count);
            $popularity = Show::where('watch_count','>',$show->watch_count)->where('category',$show->category)->count() + 1;
            $ranked = Show::where('rating','>',$show->rating)->where('category',$show->category)->count() + 1;
            $status = "Add to list";
            $rateIt = "Rate It";
            $watchedEpisodes = 0;
        }
        catch(Exception $e){
            //abort(404);
        }

        if(!auth()->guest())
        {
            if(Statistic::where('user_id',auth()->id())->where('show_id',$id)->exists())
            {
                $statistic = Statistic::where('user_id',auth()->id())->where('show_id',$id)->first();
                $rateIt = $statistic->rating;
                $status = $statistic->status;
                $watchedEpisodes = $statistic->episodes;
            }
        }

        $data = array(
            'popularity' => $popularity,
            'ranked' => $ranked,
            'show' => $show,
            'status' => $status,
            'rateIt' => $rateIt,
            'watchedEpisodes' => $watchedEpisodes
        );
        return view('admin.viewShow')->with($data);
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
        if($user->id - auth()->id() <= 0)
            abort(404);
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
        if($user->id - auth()->id() <= 0)
            abort(404);
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
