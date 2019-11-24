@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Edit Show
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit</li>
        </ol>
    <br>
    </section>
    <section class="content">
        <div class="well" style="font-family:arial;">
            <form action="{{route('shows.update',$show->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="table table-striped">
                <tr>
                    <th>Show Name</th>
                    <th>
                    <div class="form-group">
                        <input type="text" class="form-control" name="name" value="{{$show->name}}"/>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Cover Image</th>
                    <th>
                        <div class="form-group">
                            <input id="cover_image" class="form-control" type="file" name="cover_image">
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Plot</th>
                    <th>
                    <div class="form-group">
                        <textarea cols="50" rows="5" class="form-control" name="plot">{{$show->plot}}</textarea>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Episodes</th>
                    <th>
                    <div class="form-group">
                        <input type="number" class="form-control" name="episodes" value="{{$show->episodes}}"/>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Premiere Date</th>
                    <th>
                    <div class="form-group">
                        <input  class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="premiere_date" value="{{$show->premiere_date}}"/>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            @if($show->status == 'Airing')
                                <option selected>Airing</option>
                            @else
                                <option>Airing</option>
                            @endif
                            @if($show->status == "Not Aired")
                                <option selected>Not Aired</option>
                            @else
                                <option>Not Aired</option>
                            @endif
                            @if($show->status == "Finished")
                                <option selected>Finished</option>
                            @else
                                <option>Finished</option>
                            @endif
                        </select>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Category</th>
                    <th>
                    <div class="form-group">
                        <select class="form-control" name="category">
                            @if($show->category == 'Anime')
                                <option selected>Anime</option>
                            @else
                                <option>Anime</option>
                            @endif
                            @if($show->category == "TV")
                                <option selected>TV</option>
                            @else
                                <option>TV</option>
                            @endif
                            @if($show->category == "Hollywood")
                                <option selected>Hollywood</option>
                            @else
                                <option>Hollywood</option>
                            @endif
                            @if($show->category == "Bollywood")
                            <option selected>Bollywood</option>
                            @else 
                                <option>Bollywood</option>
                            @endif
                        </select>
                    </div>
                    </th>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>

@endsection