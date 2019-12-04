@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-header">Details</div>
                <div class="card-body">
                    <div class="row justify-content-center align-self-center">
                        <div class="col-md-5">
                            <img src="/storage/profile_pictures/{{$user->profile_picture}}" width="100%" height="100%" class="rounded-circle"/>
                        </div>
                        <div class="col-md-5 justify-content-center align-self-center">
                            <p><i class="fa fa-user"> {{$user->name}}</i></p> 
                            @if($user->city != "" && $user->country != "")
                                <p><i class="fa fa-map-marker"> {{$user->city}},{{$user->country}}</i></p>
                            @elseif($user->city != "" || $user->country != "")
                                <p><i class="fa fa-map-marker"> {{$user->city}}{{$user->country}}</i></p>
                            @else
                                <p><i class="fa fa-map-marker"> N/A </i></p>
                            @endif
                            <p><i class="fa fa-envelope"> {{$user->email}}</i></p> 
                            @if($user->gender == "Male")
                                <p><i class="fa fa-male"> {{$user->gender}}</i></p>
                            @elseif($user->gender == "Female")
                                <p><i class="fa fa-female"> {{$user->gender}}</i></p>
                            @else
                                <p><i class="fa fa-male"> N/A </i></p>
                            @endif
                            @if($user->website != "")
                                <p><i class="fa fa-globe"> {{$user->website}} </i></p>
                            @else
                                <p><i class="fa fa-globe"> N/A </i></p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Statistics</div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <td class="col-md-1"> <a href="profile/watching"> <i class="fa fa-circle text-success mr-2"></i> Watching </a> </td>
                            <td class="col-md-1"> {{$watching}} </td>
                        <tr>
                        <tr>
                            <td class="col-md-1"> <a href="profile/completed"> <i class="fa fa-circle text-primary mr-2"></i> Completed </a> </td>
                            <td class="col-md-1"> {{$completed}} </td>
                        <tr>
                        <tr>
                            <td class="col-md-1"> <a href="profile/on-hold"> <i class="fa fa-circle text-info mr-2"></i> On-Hold </a> </td>
                            <td class="col-md-1"> {{$onHold}} </td>
                        <tr>
                        <tr>
                            <td class="col-md-1"> <a href="profile/dropped"> <i class="fa fa-circle text-danger mr-2"></i> Dropped </a> </td>
                            <td class="col-md-1"> {{$dropped}} </td>
                        <tr>
                        <tr>
                            <td class="col-md-1"> <a href="profile/plan-to-watch"> <i class="fa fa-circle text-secondary mr-2"></i> Plan To Watch </a> </td>
                            <td class="col-md-1"> {{$planToWatch}} </td>
                        <tr>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection