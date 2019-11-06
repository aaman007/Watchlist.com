<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        return view('pages.index');
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
