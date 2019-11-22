@extends('layouts.app')

@section('content')
    <!-- <a href="/posts" class="btn btn-danger">Back</a> <hr> -->

    <h1>{{$post->title}}</h1> <hr>
    <img src="/storage/icons/date.png" class="m-1"> <strong class="m-1">{{$post->created_at}}</strong>
    by <img src="/storage/icons/male.png" class="m-1"> <a class="m-1" href="/users/{{$post->user_id}}"> <strong>{{$post->user->name}}</strong> </a>
    <hr>
    
    @if($post->cover_image != 'noname.jpg')
        <img width="100%" src="/storage/cover_images/{{$post->cover_image}}"> <br><br>
    @endif

    <div>
        {!! $post->body !!}
    </div>

    <hr>

    @if(!Auth::guest() && Auth::user()->id == $post->user_id)
        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-dark"> Edit </a>
        
        <form action="{{ route('posts.destroy',$post->id)}}" method="POST" class="form-inline float-sm-right">
            {{method_field('DELETE')}}
            @csrf
            <input type="submit" class="btn btn-outline-danger" value="Delete"/>
        </form>
    @endif
    <br><br>

@endsection