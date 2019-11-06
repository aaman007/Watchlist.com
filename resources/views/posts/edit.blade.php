@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <form method="POST" action="{{ route('posts.update',$post->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{$post->title}}"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea id="article-ckeditor" class="form-control" name="body" cols="30" rows="10">{{$post->body}}</textarea>
        </div>
        <div class="form-group">
            @csrf
            <input id="cover_image" type="file" name="cover_image">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <br>

@endsection