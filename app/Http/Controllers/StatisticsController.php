<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Statistic;
use App\Show;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        if(auth()->guest())
            return redirect('/login');
        
        $show = Show::find($id);
        if($show->status == "Not Aired")
            return redirect()->back();
        $rating = $request->input('rateIt');
        $status = $request->input('status');
        $episodes = $request->input('episodesWatched');
        
        if($episodes == "")
            $episodes = 0;
        if($rating == "")
            $rating = 0;
        if($episodes && $status == "")
            $status = ($episodes == $show->episodes) ? "Completed" : "Watching";
        if($rating > 0 && $status == "")
            $status = "Watching";

        if(Statistic::where('user_id',auth()->id())->where('show_id',$id)->exists())
        {
            $statistic = Statistic::where('user_id',auth()->id())->where('show_id',$id)->first();
            
            if($status == "Completed" && $statistic->episodes != $show->episodes)
                $episodes = $show->episodes;
            if($episodes == $show->episodes && $statistic->status != "Completed")
                $status = "Completed";
        }
        else
        {
            $statistic = new Statistic;
            $statistic->user_id = auth()->id();
            $statistic->show_id = $id;

            if($status == "Completed")
                $episodes = $show->episodes;
            if($episodes == $show->episodes)
                $status = "Completed";
        }

        $statistic->status = $status;
        $statistic->episodes = $episodes;
        $statistic->rating = $rating;
        $statistic->save();

        return back();
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
