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
        <li><a href="/admin-panel/shows"><i class="fa fa-dashboard"></i> Shows</a></li>
        <li class="active">View</li>
        </ol>
        <br>
    </section>

    <section class="content">
        <div class="well">
            <div class="row" style="padding:5px;">
                 <h1> {{$show->name}} </h1>

                <div class="col pull-left" style="margin-right:10px;">
                    <img src="/storage/cover_images/{{$show->cover_image}}" witdth="100%">
                </div>
                <!-- <br><br> -->
                <div width="col pull-left">
                    <strong> Rating : {{$show->rating}} [ Rated by {{$show->rating_count}} Users ] </strong><br>
                    <strong> Ranked : #{{$ranked}} </strong> <br>
                    <strong> Popularity : #{{$popularity}} </strong> <br>
                    <strong> Watch Count : {{$show->watch_count}} </strong> <br>
                    <strong> Category : {{$show->category}} </strong> <br>
                    <strong> Episodes : {{$show->episodes}} </strong> <br>
                    <strong> Status : {{$show->status}} </strong> <br>
                    <strong> Premiere Date : {{$show->premiere_date}} </strong> <br>
                    <br>
                    <strong>Plot</strong><br>
                    {{$show->plot}}
                </div>
            </div>
            <br>
        </div>
    </section>
@endsection