@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <a href="/posts/create" class="btn btn-primary justify-content-center">Create Post</a>
                    <br><br>
                    <h3>Your Blog Posts</h3> <br>

                    @if(count($posts))
                        <table class="table table-striped">
                            <tr>
                                <td class="col-md-6">Title</td>
                                <td class="col-sm-2"></td>
                                <td class="col-sm-2"></td>
                                <td class="col-sm-2"></td>
                            </tr>
                            @foreach($posts as $post)
                                <tr>
                                    <td class='col-md-6'>{{$post->title}}</td>
                                    <!-- <td> <a href="/posts/{{$post->id}}">{{$post->title}}</a> </td> -->
                                    <td class="col-sm-2"> 
                                        <a href="/posts/{{$post->id}}" class="btn btn-outline-dark">View</a>
                                    </td>
                                    <td class="col-sm-2">
                                        <a href="/posts/{{$post->id}}/edit" class="btn btn-outline-dark">Edit</a>
                                    </td>
                                    <td class="col-sm-2">
                                        <form action="{{ route('posts.destroy',$post->id)}}" method="POST">
                                            {{method_field('DELETE')}}
                                            @csrf
                                            <input type="submit" class="btn btn-outline-danger" value="Delete"/>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You have no blog post</p>
                    @endif
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
