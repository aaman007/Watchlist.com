@extends('layouts.app')
@section('content')
    <div class="card text-center">
        <div class="card-header">
            About Us
        </div>
        <div class="card-body">
            <h4 class="card-title">Watchlist.com</h4>
            <p class="card-text">
                    @if(count($infos))
                        <ul class="list-group">
                            @foreach($infos as $info)
                                <li class="list-group-item"> {{$info}} </li>
                            @endforeach
                        </ul>
                @endif
            </p>
            <a href="https://aaman007.wordpress.com/" class="btn btn-primary">Aaman007</a>
        </div>
    </div>
    
@endsection
