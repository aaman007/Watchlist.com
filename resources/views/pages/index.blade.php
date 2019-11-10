@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"> Currently Airing Animes </div>
        <div class="card-body">
            @if(count($animes))
                <div class="card-deck">
                    @foreach ($animes as $anime)
                        <div class="col-sm-3">
                        <div class="card h-100">
                            <img class="card-img-top" src="/storage/cover_images/{{$anime->cover_image}}" alt="{{$anime->name}}">
                            <div class="card-body">
                                <p class="card-text text-center"> <strong>{{$anime->name}}</strong></p>
                            </div>
                            <a class="card-footer btn btn-primary bg-primary" href="/shows/{{$anime->id}}"> Explore </a>
                        </div>
                        </div>
                    @endforeach
                </div>
            @else
                Nothing to show
            @endif
        </div>
        <div class="card-footer"></div>
    </div> 
    <br>
    <div class="card">
        <div class="card-header"> Currently Airing TV Shows </div>
        <div class="card-body">
                @if(count($tvs) > 3)
                <div class="card-deck">
                        @foreach ($tvs as $tv)
                        <div class="col-sm-3">
                        <div class="card h-100">
                                <img class="card-img-top" src="/storage/cover_images/{{$tv->cover_image}}" alt="{{$tv->name}}">
                                <div class="card-body">
                                <p class="card-text text-center"> <strong>{{$tv->name}}</strong></p>
                                </div>
                                <a class="card-footer btn btn-primary bg-primary" href="/shows/{{$tv->id}}"> Explore </a>
                        </div>
                        </div>
                        @endforeach
                </div>
                @else
                    Nothing to show
                @endif
        </div>
        <div class="card-footer"></div>
    </div>
    <br>
    <div class="card">
            <div class="card-header"> Upcoming Hollywood Movies </div>
            <div class="card-body">                
                @if(count($hollywoods))
                <div class="card-deck">
                        @foreach ($hollywoods as $hollywood)
                        <div class="col-sm-3">
                        <div class="card">
                                <img class="card-img-top" src="/storage/cover_images/{{$hollywood->cover_image}}" alt="{{$hollywood->name}}">
                                <div class="card-body">
                                <p class="card-text text-center"> <strong>{{$hollywood->name}}</strong></p>
                                </div>
                                <a class="card-footer btn btn-primary bg-primary" href="/shows/{{$hollywood->id}}"> Explore </a>
                        </div>
                        </div>
                        @endforeach
                </div>
                @else
                        Nothing to show
                @endif
            </div>
            <div class="card-footer"></div>
    </div>
    <br>
    <div class="card">
            <div class="card-header"> Upcoming Bollywood Movies </div>
            <div class="card-body">
                @if(count($bollywoods))
                <div class="card-deck">
                        @foreach ($bollywoods as $bollywood)
                        <div class="col-sm-3">
                        <div class="card">
                                <img class="card-img-top" src="/storage/cover_images/{{$bollywood->cover_image}}" alt="{{$bollywood->name}}">
                                <div class="card-body">
                                <p class="card-text text-center"> <strong>{{$bollywood->name}}</strong></p>
                                </div>
                                <a class="card-footer btn btn-primary bg-primary" href="/shows/{{$hollywood->id}}"> Explore </a>
                        </div>
                        </div>
                        @endforeach
                </div>
                @else
                        Nothing to show
                @endif
            </div>
            <div class="card-footer"></div>
    </div>

    
@endsection