<?php

namespace App\Http\Controllers;

use Exception;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Show;
use App\User;
use App\Log;

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

    // Anime
    public function mostWatchedAnime()
    {
        $shows = Show::where('category','Anime')->orderBy('watch_count','desc')->paginate(5);
        $data = array(
            'header' => 'Most Watched Animes',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedAnime()
    {
        $shows = Show::where('category','Anime')->orderBy('rating','desc')->paginate(5);
        $data = array(
            'header' => 'Top Rated Animes',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function currentlyAiringAnime()
    {
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
        $shows = Show::where('category','TV')->orderBy('watch_count','desc')->paginate(5);
        $data = array(
            'header' => 'Most Watched TV Shows',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedTV()
    {
        $shows = Show::where('category','TV')->orderBy('rating','desc')->paginate(5);
        $data = array(
            'header' => 'Top Rated TV Shows',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function currentlyAiringTV()
    {
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
        $shows = Show::where('category','Hollywood')->orderBy('watch_count','desc')->paginate(5);
        $data = array(
            'header' => 'Most Watched Hollywood Movies',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedHollywood()
    {
        $shows = Show::where('category','Hollywood')->orderBy('rating','desc')->paginate(5);
        $data = array(
            'header' => 'Top Rated Hollywood Movies',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    // Bollywood Movies
    public function mostWatchedBollywood()
    {
        $shows = Show::where('category','Bollywood')->orderBy('watch_count','desc')->paginate(5);
        $data = array(
            'header' => 'Most Watched Bollywood Movies',
            'shows' => $shows
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedBollywood()
    {
        $shows = Show::where('category','Bollywood')->orderBy('rating','desc')->paginate(5);
        $data = array(
            'header' => 'Top Rated Bollywood Movies',
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
    public function show($id)
    {
        try{
            $show = Show::find($id);
            $popularity = Show::where('watch_count','>',$show->watch_count)->count() + 1;
            $ranked = Show::where('rating','>',$show->rating)->count() + 1;
            $status = "Add to list";
            $rateIt = "Rate It";
            $watchedEpisodes = 0;
        }
        catch(Exception $e){
            abort(404);
        }

        if(!auth()->guest())
        {
            
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
