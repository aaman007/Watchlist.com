<?php

namespace App\Http\Controllers;
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
        $data = array(
            'header' => 'Most Watched Animes'
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedAnime()
    {
        $data = array(
            'header' => 'Top Rated Animes'
        );
        return view('shows.shows_list')->with($data);
    }
    public function currentlyAiringAnime()
    {
        $data = array(
            'header' => 'Currently Airing Animes'
        );
        return view('shows.shows_list')->with($data);
    }
    // TV Shows
    public function mostWatchedTV()
    {
        $data = array(
            'header' => 'Most Watched TV Shows'
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedTV()
    {
        $data = array(
            'header' => 'Top Rated TV Shows'
        );
        return view('shows.shows_list')->with($data);
    }
    public function currentlyAiringTV()
    {
        $data = array(
            'header' => 'Currently Airing TV Shows'
        );
        return view('shows.shows_list')->with($data);
    }
    // Hollywood Movies
    public function mostWatchedHollywood()
    {
        $data = array(
            'header' => 'Most Watched Hollywood Movies'
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedHollywood()
    {
        $data = array(
            'header' => 'Top Rated Hollywood Movies'
        );
        return view('shows.shows_list')->with($data);
    }
    // Bollywood Movies
    public function mostWatchedBollywood()
    {
        $data = array(
            'header' => 'Most Watched Bollywood Movies'
        );
        return view('shows.shows_list')->with($data);
    }
    public function topRatedBollywood()
    {
        $data = array(
            'header' => 'Top Rated Bollywood Movies'
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
        dd($request->file('cover_image'));
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
        $show->user_id = Auth::user()->id;
        $show->watch_count = $show->rating_count = 0;
        $show->rating = 0.00;
        $show->save();

        // Adding Logs
        $log = new Log;
        $log->details = Auth::user()->name . " added a show named " . $show->name;
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
        //
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
        //
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
