@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Add New Show
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add New Show</li>
        </ol>
    <br>
    </section>
    <section class="content">
        <div class="well" style="font-family:arial;">
            <form action="{{route('shows.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <table class="table table-striped">
                <tr>
                    <th>Show Name</th>
                    <th>
                    <div class="form-group">
                        <input required type="text" class="form-control" name="name" placeholder="e.g, Avengers"/>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Cover Image</th>
                    <th>
                        <div class="form-group">
                            <input required id="cover_image" class="form-control" type="file" name="cover_image">
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Plot</th>
                    <th>
                    <div class="form-group">
                        <textarea required cols="50" rows="5" class="form-control" name="plot" placeholder="e.g, How will the avengers defend earth after a shocking...."></textarea>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Episodes</th>
                    <th>
                    <div class="form-group">
                        <input required type="number" class="form-control" name="episodes" placeholder="e.g, 12"/>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Premiere Date</th>
                    <th>
                    <div class="form-group">
                        <input required class="form-control" data-provide="datepicker" data-date-format="yyyy-mm-dd" name="premiere_date" placeholder="e.g, 2020-12-19"/>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Status</th>
                    <th>
                    <div class="form-group">
                        <select class="form-control" name="status">
                            <option value="Airing">Airing</option>
                            <option value="Not Aired">Not Aired</option>
                            <option value="Finished">Finished</option>
                        </select>
                    </div>
                    </th>
                </tr>
                <tr>
                    <th>Category</th>
                    <th>
                    <div class="form-group">
                        <select class="form-control" name="category">
                            <option value="Anime">Anime</option>
                            <option value="TV">TV</option>
                            <option value="Hollywood">Hollywood</option>
                            <option value="Bollywood">Bollywood</option>
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