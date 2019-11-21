@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            @csrf            
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title"/>
        </div>
        <div class="form-group">
            @csrf
            <label for="body">Body</label>
            <textarea id="article-ckeditor" class="form-control" name="body" cols="30" rows="10" placeholder="Body Text"></textarea>
        </div>
        <div class="form-group">
            @csrf
            <input id="cover_image" type="file" name="cover_image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>

@endsection