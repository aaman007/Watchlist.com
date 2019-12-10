@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Edit Post
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin-panel/posts"><i class="fa fa-dashboard"></i> Posts</a></li>
        <li class="active">Edit</li>
        </ol>
        <br>
    </section>

    <section class="content">
        <form method="POST" action="{{route('admin.posts.update',$post->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input required type="text" class="form-control" name="title" value="{{$post->title}}"/>
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
    </section>

@endsection