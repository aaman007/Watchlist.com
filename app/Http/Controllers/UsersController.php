<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Log;
use App\Statistic;
use App\Show;
use App\Post;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth' , ['only' => ['create','update','destroy','store','profile']]);
    }
    public function checkEligibility()
    {
        if(auth()->guest())
            abort(404);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     /// User Profile and List Related Functions
    public function index()
    {
        $users = User::orderBy('name','asc')->paginate(15);
        return view('users.index')->with('users',$users);
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('name',$search)->orWhere('name','like','%'.$search.'%')->orderBy('name','asc')->paginate(15);
        $users->appends(['search' => $search]);
        return view('users.index')->with('users',$users);
    }
    public function update_details()
    {
        $user = User::find(auth()->user()->id);
        return view('users.update_details')->with('user',$user);
    }
    public function profile(Request $request)
    {
        $user = auth()->user();
        $posts = Post::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(5);
        $watching = Statistic::where('user_id',$user->id)->where('status','Watching')->count();
        $completed = Statistic::where('user_id',$user->id)->where('status','Completed')->count();
        $planToWatch = Statistic::where('user_id',$user->id)->where('status','Plan To Watch')->count();
        $onHold = Statistic::where('user_id',$user->id)->where('status','On-Hold')->count();
        $dropped = Statistic::where('user_id',$user->id)->where('status','dropped')->count();
        $data = array(
            'user' => $user,
            'posts' => $posts,
            'watching' => $watching,
            'completed' => $completed,
            'onHold' => $onHold,
            'dropped' => $dropped,
            'planToWatch' => $planToWatch
        );
        return view('users.profile')->with($data);
    }
    public function myPosts(Request $request)
    {
        $posts = Post::where('user_id',auth()->id())->orderBy('created_at','desc')->paginate(5);
        if ($request->ajax()) {
            return view('users.userPosts')->with('posts',$posts);
        }
        return view('users.profile')->with('posts',$posts);
    }

    /// Update Show's Ratings
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
    public function updateShows()
    {
        $ids = Show::select('id')->get();
        foreach($ids as $id)
        {
            $show = Show::find($id->id);
            $show->watch_count = self::getWatchCount($show->id);
            $rating_count = self::getRatingCount($show->id);
            $rating_sum = self::getRatingSum($show->id);
            if($rating_count)
                $show->rating = (1.0 * $rating_sum) / $rating_count;
            $show->save();
        }
    }
    // Other User's Watchlist Functions
    public function watching($id)
    {        
        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',$id)
                ->where('statistics.status','Watching')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'Watching',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function completed($id)
    {
        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',$id)
                ->where('statistics.status','Completed')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'Completed',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function onHold($id)
    {
        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',$id)
                ->where('statistics.status','On-Hold')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'On Hold',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function dropped($id)
    {
        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',$id)
                ->where('statistics.status','dropped')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'Dropped',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function planToWatch($id)
    {
        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',$id)
                ->where('statistics.status','Plan To Watch')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'Plan To Watch',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }

    // My Watchlist Functions
    public function myWatching()
    {
        self::checkEligibility();

        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',auth()->id())
                ->where('statistics.status','Watching')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'Watching',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function myCompleted()
    {
        self::checkEligibility();

        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',auth()->id())
                ->where('statistics.status','Completed')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'Completed',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function myOnHold()
    {
        self::checkEligibility();

        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',auth()->id())
                ->where('statistics.status','On-Hold')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'On Hold',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function myDropped()
    {
        self::checkEligibility();

        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',auth()->id())
                ->where('statistics.status','dropped')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'Dropped',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function myPlanToWatch()
    {
        self::checkEligibility();

        self::updateShows();
        $shows = DB::table('shows')
                ->select(['shows.id','shows.name','shows.cover_image','shows.category','shows.premiere_date','shows.episodes','shows.rating','shows.watch_count'])
                ->join('statistics','statistics.show_id','=','shows.id')
                ->where('statistics.user_id',auth()->id())
                ->where('statistics.status','Plan To Watch')
                ->orderBy('name','asc')
                ->paginate(15);
        $data = array(
            'header' => 'Plan To Watch',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }

    /// CRUD Functionality Functions

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $posts = Post::where('user_id',$user->id)->orderBy('created_at','desc')->paginate(5);
        $watching = Statistic::where('user_id',$user->id)->where('status','Watching')->count();
        $completed = Statistic::where('user_id',$user->id)->where('status','Completed')->count();
        $planToWatch = Statistic::where('user_id',$user->id)->where('status','Plan To Watch')->count();
        $onHold = Statistic::where('user_id',$user->id)->where('status','On-Hold')->count();
        $dropped = Statistic::where('user_id',$user->id)->where('status','dropped')->count();
        $data = array(
            'user' => $user,
            'posts' => $posts,
            'watching' => $watching,
            'completed' => $completed,
            'onHold' => $onHold,
            'dropped' => $dropped,
            'planToWatch' => $planToWatch
        );
        if(auth()->guest() || auth()->id() != $user->id)
            return view('users.user_profile')->with($data);
        else
            return redirect('/profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'currentPassword' => 'required',
            'newPassword' => 'nullable|min:8',
            'profile_picture' => 'image|nullable|max:1999',
            'website' => 'nullable|url'
        ]);

        $user = User::find($id);
        $currentPassword = $request->input('currentPassword');
        $newPassword = $request->input('newPassword');

        if(Hash::check($currentPassword,$user->password)){
            $user->name = $request->input('name');

            if($newPassword != '')
                $user->password = Hash::make($newPassword);

            if($request->input('gender') != "Select")
                $user->gender = $request->input('gender');

            $user->city = $request->input('city');
            $user->country = $request->input('country');
            $user->website = $request->input('website');

            // Handle file upload
            if($request->hasFile('profile_picture')){

                // Get filename with extention
                $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();

                // Get filename
                $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

                // Get Extension
                $extension = $request->file('profile_picture')->getClientOriginalExtension();

                $filenameToStore = $filename . "_" . time() . "." . $extension;

                // Upload Image
                $path = $request->file('profile_picture')->storeAs('public/profile_pictures',$filenameToStore);
            }
            if($request->hasFile('profile_picture')){
                if($user->profile_picture != 'noimage.jpg')
                    Storage::delete('public/profile_pictures/'.$user->profile_picture);
                $user->profile_picture = $filenameToStore;
            }

            $user->save();

            // Insertion of Log
            $log = new Log;
            $log->details = auth()->user()->name . " updated his profile details";
            $log->save();

            return redirect('/update-details')->with('success','Profile Updated');
        }
        else
            return redirect('/update-details')->with('error','Wrong Current Password');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
