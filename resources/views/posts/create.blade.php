@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>
    <form method="POST" action="{{route('posts.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input required type="text" class="form-control" name="title" placeholder="Title"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="article-ckeditor" class="form-control" name="body" cols="30" rows="10" placeholder="Body Text" required></textarea>
        </div>
        <div class="form-group">
            <input id="cover_image" type="file" name="cover_image">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>

@endsection