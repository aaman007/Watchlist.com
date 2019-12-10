@extends('layouts.app')

@push('js')
    <script src="jquery-3.4.1.min.js"></script>
@endpush

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
                            <p><i class="fa fa-star">
                                @if($user->rank == 1)
                                    <span class='text-primary text-bold'>{{$user->title}}</span>
                                @elseif($user->rank == 2)
                                    <span class='text-success text-bold'>{{$user->title}}</span>
                                @elseif($user->rank == 3)
                                    <span class='text-info text-bold'>{{$user->title}}</span>
                                @else
                                    <span class='text-secondary text-bold'>{{$user->title}}</span>
                                @endif
                            </i></p>
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
                                <p><i class="fa fa-globe"> <a href="{{$user->website}}"> {{$user->website}}</a> </i></p>
                            @else
                                <p><i class="fa fa-globe"> N/A </i></p>
                            @endif
                            <p><i class="fa fa-registered"> {{$user->created_at->diffForHumans()}} </i></p>
                        </div>
                    </div>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
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
    <div class="row" id="blog_posts">
        <div class="col-md-8 mb-2">
            <div class="card">
                <div class="card-header"> Blog Posts </div>
                <div class="card-body">
                    @if(count($posts))
                        <div id="user_posts">
                            @include('users.userPosts')
                        </div>
                    @else
                        No Posts to show
                    @endif
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
        <!--
        <div class="col-md-4">
            <div class="card">
                <img class="card-img-top" src="/storage/profile_pictures/{{$user->profile_picture}}" alt="Card image">
                <div class="card-body">
                    <h4 class="card-title">{{$user->name}}</h4>
                    <p class="card-text">Some example text some example text. John Doe is an architect and engineer</p>
                    <a href="/users/{{$user->id}}" class="btn btn-primary">See Profile</a>
                </div>
            </div>
        </div>
        -->
    </div>
    <script type="text/javascript">
        $(window).on('hashchange', function() {
            if (window.location.hash) {
                let page = window.location.hash.replace('#', '');
                if (page == Number.NaN || page <= 0) {
                    return false;
                }else{
                    updateData(page);
                }
            }
        });
        $(document).on('click','.pagination a',function(e){
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            updateData(page);
        });
        function updateData(page)
        {
            $.ajax({
                url : '?page='+page
            }).done(function(data){
                $('#user_posts').html(data);
                location.hash = page;
            });
        }
    </script>
@endsection