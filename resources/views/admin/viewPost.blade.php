@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        View
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/admin-panel/posts"><i class="fa fa-dashboard"></i> Posts</a></li>
        <li class="active">View</li>
        </ol>
        <br>
    </section>

    <section class="content">
        <h1>{{$post->title}}</h1> <hr>
        <img src="/storage/icons/date.png" class="m-1"> <strong class="m-1">{{$post->created_at}}</strong>
        by <img src="/storage/icons/male.png" class="m-1"> <a class="m-1" href="/admin-panel/users/{{$post->user_id}}"> <strong>{{$post->user->name}}</strong> </a>
        <hr>
    
        @if($post->cover_image != 'noname.jpg')
            <img width="100%" src="/storage/cover_images/{{$post->cover_image}}"> <br><br>
        @endif
    
        <div>
            {!! $post->body !!}
        </div>
    </section>

@endsection