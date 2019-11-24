@extends('layouts.admin')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Shows
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Shows</li>
        </ol>
        <br>
    </section>

    <section class="content">
        @if(count($shows))
            <table class="table table-striped text-center">
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            @foreach($shows as $show)
                <tr>
                <td>{{$show->name}}</td>
                <td>{{$show->category}}</td>
                <td>
                    <a href="/admin-panel/shows/{{$show->id}}" class="btn btn-info"> View</a>
                    <a href="/admin-panel/shows/edit/{{$show->id}}" class="btn btn-primary"> Edit</a>
                    <a href="/admin-panel/shows/delete/{{$show->id}}" class="btn btn-danger"> Delete</a>
                </td>
                </tr>
            @endforeach
            </table>
            {{$shows->links()}} <!-- Pagination -->
        @else
            No Posts Available
        @endif
    </section>

@endsection