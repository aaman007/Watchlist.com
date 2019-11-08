@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header"> Now Airing Animes </div>
        <div class="card-body">
                <div class="card-deck">
                        <div class="card" style="width:12rem;height:26rem;">
                                <img class="card-img-top" src="https://cdn.myanimelist.net/images/anime/1505/102719l.jpg" alt="Card image cap">
                                <div class="card-body">
                                        <p class="card-text text-center"> <strong>Aho No Sora</strong></p>
                                </div>
                        </div>
                        <div class="card" style="width: 12rem;height:26rem;">
                                <img class="card-img-top" src="https://cdn.myanimelist.net/images/anime/1315/102961l.jpg" alt="Card image cap">
                                <div class="card-body">
                                        <p class="card-text text-center"> <strong>Boku no Hero Academia 4th Season</strong></p>
                                </div>
                        </div>
                        <div class="card" style="width:12rem;height:26rem;">
                                <img class="card-img-top" src="https://cdn.myanimelist.net/images/anime/1204/103282l.jpg" alt="Card image cap">
                                <div class="card-body">
                                        <p class="card-text text-center"> <strong>Psycho-Pass 3</strong></p>
                                </div>
                        </div>
                        <div class="card" style="width:12rem;height:26rem;">
                                <img class="card-img-top" src="https://cdn.myanimelist.net/images/anime/1531/102113l.jpg" alt="Card image cap">
                                <div class="card-body">
                                        <p class="card-text text-center"> <strong>No Guns Life</strong></p>
                                </div>
                         </div>
                </div>
        </div>
        <div class="card-footer"></div>
    </div> 
    <br>
    <div class="card">
            <div class="card-header"> Now Airing TV Shows </div>
            <div class="card-body">
            </div>
            <div class="card-footer"></div>
    </div>
    <br>
    <div class="card">
            <div class="card-header"> Upcoming Hollywood Movies </div>
            <div class="card-body">
            </div>
            <div class="card-footer"></div>
    </div>
    <br>
    <div class="card">
            <div class="card-header"> Upcoming Bollywood Movies </div>
            <div class="card-body">
            </div>
            <div class="card-footer"></div>
    </div>
    
@endsection