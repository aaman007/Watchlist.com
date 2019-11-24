<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Log;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(15);
        return view('admin.posts_list')->with('posts',$posts);
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
        $post = POST::find($id);

        return view('admin.viewPost')->with('post',$post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('admin.editPost')->with('post',$post);
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
            'title' => 'required|max:140', 
            'body' => 'required' ,
            'cover_image' => 'image|nullable|max:1999'
        ]);

        // Handle file upload
        if($request->hasFile('cover_image')){

            // Get filename with extention
            $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

            // Get filename
            $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

            // Get Extension
            $extension = $request->file('cover_image')->getClientOriginalExtension();

            $filenameToStore = $filename . "_" . time() . "." . $extension;

            // Upload Image
            $path = $request->file('cover_image')->storeAs('public/cover_images',$filenameToStore);
        }
        // Update Post
        $post = Post::find($id);

        // Insertion of Log
        $log = new Log;
        $log->details = auth()->user()->name . " edited post " . $post->title;
        $log->save();

        $post->title = $request->input('title');
        $post->body = $request->input('body');

        if($request->hasFile('cover_image')){
            if($post->cover_image != 'noname.jpg')
                Storage::delete('public/cover_images/'.$post->cover_image);
            $post->cover_image = $filenameToStore;
        }
        $post->save();

        return redirect('/admin-panel/posts')->with('success','Post Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        
        if($post->cover_image != 'noname.jpg'){
            Storage::delete('public/cover_images/'.$post->cover_image);
        }
        $post->delete();

        // Insertion of Log
        $log = new Log;
        $log->details = auth()->user()->name . " deleted post " . $post->title;
        $log->save();

        return redirect('/admin-panel/posts')->with('success','Post Removed');
    }
}
