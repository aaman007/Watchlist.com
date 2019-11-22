@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            {{$show->name}}
        </div>
        <div class="card-body">
            <div class="row">
                <img src="/storage/cover_images/{{$show->cover_image}}" width="30%" height="90%">
                <div class="col">
                    <strong> Rating : {{$show->rating}} [ Rated by {{$show->rating_count}} Users ] </strong><br>
                    <strong> Ranked : #{{$ranked}} </strong> <br>
                    <strong> Popularity : #{{$popularity}} </strong> <br>
                    <strong> Watch Count : {{$show->watch_count}} </strong> <br>
                    <strong> Episodes : {{$show->episodes}} </strong> <br>
                    <strong> Premiere Date : {{$show->premiere_date}} </strong> <br>
                    <br>
                    <div class="row">
                        <form method="POST" action="{{ route('statistics.update',$show->id) }}" enctype="multipart/form-data">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" style="text-color:white;" name="status">

                                        @if($status == "Add to list")
                                            <option value='' selected disabled><strong>+ Add to list</strong></option>
                                        @else
                                            <option value=''disabled><strong>+ Add to list</strong></option>
                                        @endif

                                        @if($status == "Watching")
                                            <option class="btn btn-outline-success" selected>Watching</option>
                                        @else
                                            <option class="btn btn-outline-success">Watching</option>
                                        @endif

                                        @if($status == "Completed")
                                            <option class="btn btn-outline-success" selected>Completed</option>
                                        @else
                                            <option class="btn btn-outline-success">Completed</option>
                                        @endif

                                        @if($status == "On-Hold")
                                            <option class="btn btn-outline-success" selected>On-Hold</option>
                                        @else
                                            <option class="btn btn-outline-success">On-Hold</option>
                                        @endif

                                        @if($status == "Dropped")
                                            <option class="btn btn-outline-success" selected>Dropped</option>
                                        @else
                                            <option class="btn btn-outline-success">Dropped</option>
                                        @endif

                                        @if($status == "Plan to Watch")
                                            <option class="btn btn-outline-success" selected>Plan to Watch</option>
                                        @else
                                            <option class="btn btn-outline-success">Plan to Watch</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" name="rateIt">
                                        @if($rateIt == "Rate It")
                                            <option class="btn btn-outline-primary" value='' selected disabled><strong>* Rate It</strong></option>
                                        @else
                                            <option class="btn btn-outline-primary" value='' disabled><strong>* Rate It</strong></option>
                                        @endif
                                        
                                        @if($rateIt == "(10) Masterpiece")
                                            <option class="btn btn-outline-success" selected>(10) Masterpiece</option>
                                        @else
                                            <option class="btn btn-outline-success">(10) Masterpiece</option>
                                        @endif

                                        @if($rateIt == "(9) Great")
                                            <option class="btn btn-outline-success" selected>(9) Great</option>
                                        @else
                                            <option class="btn btn-outline-success">(9) Great</option>
                                        @endif

                                        @if($rateIt == "(8) Very Good")
                                            <option class="btn btn-outline-success" selected>(8) Very Good</option>
                                        @else
                                            <option class="btn btn-outline-success">(8) Very Good</option>
                                        @endif

                                        @if($rateIt == "(7) Good")
                                            <option class="btn btn-outline-success" selected>(7) Good</option>
                                        @else
                                            <option class="btn btn-outline-success">(7) Good</option>
                                        @endif

                                        @if($rateIt == "(6) Fine")
                                            <option class="btn btn-outline-success" selected>(6) Fine</option>
                                        @else
                                            <option class="btn btn-outline-success">(6) Fine</option>
                                        @endif

                                        @if($rateIt == "(5) Average")
                                            <option class="btn btn-outline-success" selected>(5) Average</option>
                                        @else
                                            <option class="btn btn-outline-success">(5) Average</option>
                                        @endif

                                        @if($rateIt == "(4) Bad")
                                            <option class="btn btn-outline-success" selected>(4) Bad</option>
                                        @else
                                            <option class="btn btn-outline-success">(4) Bad</option>
                                        @endif

                                        @if($rateIt =="(3) Very Bad")
                                            <option class="btn btn-outline-success" selected>(3) Very Bad</option>
                                        @else
                                            <option class="btn btn-outline-success">(3) Very Bad</option>
                                        @endif

                                        @if($rateIt == "(2) Horrible")
                                            <option class="btn btn-outline-success" selected>(2) Horrible</option>
                                        @else
                                            <option class="btn btn-outline-success">(2) Horrible</option>
                                        @endif 

                                        @if($rateIt == "(1) Apalling")
                                            <option class="btn btn-outline-success" selected>(1) Apalling</option>
                                        @else
                                            <option class="btn btn-outline-success">(1) Apalling</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    Episodes : <input class="text-center" value="{{$watchedEpisodes}}" type="number" min="0" max="{{$show->episodes}}" name="episodesWatched"> /{{$show->episodes}}
                                </div>
                            </div>
                        <form>
                    </div>
                    <br>
                    <strong>Plot</strong><br>
                    {{$show->plot}}
                </div>
            </div>
        </div>
        <div class="card-footer">
        </div>
    </div>
@endsection