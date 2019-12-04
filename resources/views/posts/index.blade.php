@extends('layouts.app')

@section('content')
    <h1>Posts</h1>

    @if(count($posts))
        @foreach($posts as $post)
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <!-- <div class="col-md-4 col-sm-4">
                            <img class="img-responsive" height="230" style="width:100%" src="/storage/cover_images/{{$post->cover_image}}">
                        </div> -->
                        <div class="p-2">
                            <a style="text-decoration:none;" href="posts/{{$post->id}}"> <h5>{{$post->title}}</h5> </a>
                            <small>Written {{$post->created_at->diffForHumans()}} by <a href="users/{{$post->user->id}}">{{$post->user->name}}</a></small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <br>
        {{$posts->links()}} <!-- Pagination -->
    @else
        <p>No Posts Found</p>
    @endif
    <br>
@endsection