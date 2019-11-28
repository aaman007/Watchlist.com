<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Show;
use App\User;
use App\Log;
use App\Statistic;

class ShowsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    // Anime
    public function mostWatchedAnime()
    {
        self::updateShows();
        $shows = Show::where('category','Anime')->orderBy('watch_count','desc')->orderBy('rating','desc')->paginate(5);
        $data = array(
            'header' => 'Most Watched Animes',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedAnime()
    {
        self::updateShows();
        $shows = Show::where('category','Anime')->orderBy('rating','desc')->orderBy('watch_count','desc')->paginate(5);
        $data = array(
            'header' => 'Top Rated Animes',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function currentlyAiringAnime()
    {
        self::updateShows();
        $shows = Show::where('category','Anime')->where('status','Airing')->orderBy('name','asc')->paginate(5);
        $data = array(
            'header' => 'Currently Airing Animes',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    // TV Shows
    public function mostWatchedTV()
    {
        self::updateShows();
        $shows = Show::where('category','TV')->orderBy('watch_count','desc')->orderBy('rating','desc')->paginate(5);
        $data = array(
            'header' => 'Most Watched TV Shows',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedTV()
    {
        self::updateShows();
        $shows = Show::where('category','TV')->orderBy('rating','desc')->orderBy('watch_count','desc')->paginate(5);
        $data = array(
            'header' => 'Top Rated TV Shows',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function currentlyAiringTV()
    {
        self::updateShows();
        $shows = Show::where('category','TV')->where('status','Airing')->orderBy('name','asc')->paginate(5);
        $data = array(
            'header' => 'Currently Airing TV Shows',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    // Hollywood Movies
    public function mostWatchedHollywood()
    {
        self::updateShows();
        $shows = Show::where('category','Hollywood')->orderBy('watch_count','desc')->orderBy('rating','desc')->paginate(5);
        $data = array(
            'header' => 'Most Watched Hollywood Movies',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedHollywood()
    {
        self::updateShows();
        $shows = Show::where('category','Hollywood')->orderBy('rating','desc')->orderBy('watch_count','desc')->paginate(5);
        $data = array(
            'header' => 'Top Rated Hollywood Movies',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    // Bollywood Movies
    public function mostWatchedBollywood()
    {
        self::updateShows();
        $shows = Show::where('category','Bollywood')->orderBy('watch_count','desc')->orderBy('rating','desc')->paginate(5);
        $data = array(
            'header' => 'Most Watched Bollywood Movies',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedBollywood()
    {
        self::updateShows();
        $shows = Show::where('category','Bollywood')->orderBy('rating','desc')->orderBy('watch_count','desc')->paginate(5);
        $data = array(
            'header' => 'Top Rated Bollywood Movies',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function searchAnime()
    {
        self::updateShows();
        $search = $_GET['search'];
        $shows = Show::where('name',$search)->orWhere('name','like','%'.$search.'%')->orderBy('name','asc')->paginate(10);
        $data = array(
            'header' => 'Search results for ' . $search,
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shows.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|max:140',
            'plot' => 'required',
            'cover_image' => 'required|image|max:1999',
            'episodes' => 'required|numeric',
            'premiere_date' => 'required|date',
            'status' => 'required',
            'category' => 'required'

        ]);
        // Handle file upload
        
        // Get filename with extention
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
        // Get filename
        $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
        // Get Extension
        $extension = $request->file('cover_image')->getClientOriginalExtension();
        $filenameToStore = $filename . "_" . time() . "." . $extension;
        // Upload Image
        $path = $request->file('cover_image')->storeAs('public/cover_images',$filenameToStore);

        // Storing data in database
        $show = new Show;
        $show->name = $request->input('name');
        $show->cover_image = $filenameToStore;
        $show->plot = $request->input('plot');
        $show->episodes = $request->input('episodes');
        $show->premiere_date = $request->input('premiere_date');
        $show->status = $request->input('status');
        $show->category = $request->input('category');
        $show->user_id = auth()->user()->id;
        $show->watch_count = $show->rating_count = 0;
        $show->rating = 0.00;
        $show->save();

        // Adding Logs
        $log = new Log;
        $log->details = auth()->user()->name . " added a show named " . $show->name;
        $log->save();

        return redirect('/admin-panel/shows')->with('success','Show Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function show($id)
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
        return view('shows.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show = Show::find($id);

        return view('shows.edit')->with('show',$show);
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
            'name' => 'required|max:140',
            'plot' => 'required',
            'cover_image' => 'nullable|image|max:1999',
            'episodes' => 'required|numeric',
            'premiere_date' => 'required|date',
            'status' => 'required',
            'category' => 'required'

        ]);
        $show = Show::find($id);

        // Handle file upload
        if($request->hasFile('cover_image'))
        {
            // Get filename with extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
            // Get filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);
            // Get Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();
            $filenameToStore = $filename . "_" . time() . "." . $extension;
            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$filenameToStore);

            if($show->cover_image != "nocover.jpg")
                Storage::delete('public/cover_images/'.$show->cover_image);
            $show->cover_image = $filenameToStore;
        }

        // Storing data in database
        $show->name = $request->input('name');
        $show->plot = $request->input('plot');
        $show->episodes = $request->input('episodes');
        $show->premiere_date = $request->input('premiere_date');
        $show->status = $request->input('status');
        $show->category = $request->input('category');
        $show->save();

        // Adding Logs
        $log = new Log;
        $log->details = auth()->user()->name . " edited a show named " . $show->name;
        $log->save();

        return redirect('/admin-panel/shows')->with('success','Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $show = Show::find($id);
        
        if($show->cover_image != 'nocover.jpg'){
            Storage::delete('public/cover_images/'.$show->cover_image);
        }
        $show->delete();

        // Insertion of Log
        $log = new Log;
        $log->details = auth()->user()->name . " deleted show named " . $show->name;
        $log->save();

        return redirect('/admin-panel/shows')->with('success','Show Removed');
    }
}
