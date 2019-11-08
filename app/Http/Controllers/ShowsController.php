<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    public function nowAiringAnime()
    {
        $data = array(
            'header' => 'Now Airing Animes'
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
    public function nowAiringTV()
    {
        $data = array(
            'header' => 'Now Airing TV Shows'
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
