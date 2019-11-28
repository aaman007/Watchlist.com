@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">
            {{$show->name}}
        </div>
        <div class="card-body">
            <div class="row">
                <img src="/storage/cover_images/{{$show->cover_image}}" width="40%">
                <div class="col">
                    <strong> Rating : {{$show->rating}} [ Rated by {{$show->rating_count}} Users ] </strong><br>
                    <strong> Ranked : #{{$ranked}} </strong> <br>
                    <strong> Popularity : #{{$popularity}} </strong> <br>
                    <strong> Watch Count : {{$show->watch_count}} </strong> <br>
                    <strong> Episodes : {{$show->episodes}} </strong> <br>
                    <strong> Status : {{$show->status}} </strong> <br>
                    <strong> Premiere Date : {{$show->premiere_date}} </strong> <br>
                    <br>
                    <div class="row">
                        <form method="POST" action="{{ route('statistics.update',$show->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-control" style="text-color:white;" name="status" onchange="this.form.submit()">

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
                                    <select class="form-control" name="rateIt" onchange="this.form.submit()">
                                        @if($rateIt == "Rate It")
                                            <option class="btn btn-outline-primary" value='' selected disabled><strong>* Rate It</strong></option>
                                        @else
                                            <option class="btn btn-outline-primary" value='' disabled><strong>* Rate It</strong></option>
                                        @endif
                                        
                                        @if($rateIt == 10)
                                            <option class="btn btn-outline-success" selected value="10">(10) Masterpiece</option>
                                        @else
                                            <option class="btn btn-outline-success" value="10">(10) Masterpiece</option>
                                        @endif

                                        @if($rateIt == 9)
                                            <option class="btn btn-outline-success" selected value="9">(9) Great</option>
                                        @else
                                            <option class="btn btn-outline-success" value="9">(9) Great</option>
                                        @endif

                                        @if($rateIt == 8)
                                            <option class="btn btn-outline-success" selected value="8">(8) Very Good</option>
                                        @else
                                            <option class="btn btn-outline-success" value="8">(8) Very Good</option>
                                        @endif

                                        @if($rateIt == 7)
                                            <option class="btn btn-outline-success" selected value="7">(7) Good</option>
                                        @else
                                            <option class="btn btn-outline-success" value="7">(7) Good</option>
                                        @endif

                                        @if($rateIt == 6)
                                            <option class="btn btn-outline-success" selected value="6">(6) Fine</option>
                                        @else
                                            <option class="btn btn-outline-success" value="6">(6) Fine</option>
                                        @endif

                                        @if($rateIt == 5)
                                            <option class="btn btn-outline-success" selected value="5">(5) Average</option>
                                        @else
                                            <option class="btn btn-outline-success" value="5">(5) Average</option>
                                        @endif

                                        @if($rateIt == 4)
                                            <option class="btn btn-outline-success" selected value="4">(4) Bad</option>
                                        @else
                                            <option class="btn btn-outline-success" value="4">(4) Bad</option>
                                        @endif

                                        @if($rateIt == 3)
                                            <option class="btn btn-outline-success" selected value="3">(3) Very Bad</option>
                                        @else
                                            <option class="btn btn-outline-success" value="3">(3) Very Bad</option>
                                        @endif

                                        @if($rateIt == 2)
                                            <option class="btn btn-outline-success" selected value="2">(2) Horrible</option>
                                        @else
                                            <option class="btn btn-outline-success" value="2">(2) Horrible</option>
                                        @endif 

                                        @if($rateIt == 1)
                                            <option class="btn btn-outline-success" selected value="1">(1) Apalling</option>
                                        @else
                                            <option class="btn btn-outline-success" value="1">(1) Apalling</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    Episodes : <input class="text-center" onchange="this.form.submit()" value="{{$watchedEpisodes}}" type="number" min="0" max="{{$show->episodes}}" name="episodesWatched"> /{{$show->episodes}}
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