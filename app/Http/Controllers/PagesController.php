<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Show;

class PagesController extends Controller
{
    public function index()
    {
        $animes = Show::where('status','Airing')->where('category','Anime')->orderBy('rating','desc')->take(8)->get();
        $tvs = Show::where('status','Airing')->where('category','TV')->orderBy('rating','desc')->take(8)->get();
        $hollywoods = Show::where('status','Not Aired')->where('category','Hollywood')->orderBy('premiere_date','asc')->take(8)->get();
        $bollywoods = Show::where('status','Not Aired')->where('category','Bollywood')->orderBy('premiere_date','asc')->take(8)->get();
        $data = array(
            'animes' => $animes,
            'tvs' => $tvs,
            'hollywoods' => $hollywoods,
            'bollywoods' => $bollywoods
        );
        return view('pages.index')->with($data);
    }
    public function about()
    {
        $infos = [
            'Developer : Amanur Rahman' ,
            'University : Metropolitan University,Sylhet',
            'Department : Computer Science and Engineering',
            'Framework : Laravel 5.8'
        ];

        return view('pages.about')->with('infos',$infos);
    }
}
