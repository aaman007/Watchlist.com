@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Posts
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Posts</li>
        </ol>
        <br>
    </section>

    <section class="content">
        @if(count($posts))
            <table class="table table-striped text-center">
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Actions</th>
                </tr>
            @foreach($posts as $post)
                <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->user->name}}</td>
                <td>
                    <a href="/admin-panel/posts/{{$post->id}}" class="btn btn-info"> View</a>
                    <a href="/admin-panel/posts/edit/{{$post->id}}" class="btn btn-primary"> Edit</a>
                    <a href="/admin-panel/posts/delete/{{$post->id}}" class="btn btn-danger"> Delete</a>
                </td>
                </tr>
            @endforeach
            </table>
            {{$posts->links()}} <!-- Pagination -->
        @else
            No Posts Available
        @endif
    </section>

@endsection