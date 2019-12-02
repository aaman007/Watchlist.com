@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Details</div>
                <div class="card-body">
                    <img src="/storage/profile_pictures/{{$user->profile_picture}}" height="60%" width="60%"> <br><br>
                    Name : {{$user->name}} <br>
                    Email : {{$user->email}} <br>
                    @if($user->gender != "")
                        Gender : {{$user->gender}} <br>
                    @endif
                    @if($user->city != "")
                        City : {{$user->city}} <br>
                    @endif
                    @if($user->country != "")
                        Country : {{$user->country}} <br>
                    @endif
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