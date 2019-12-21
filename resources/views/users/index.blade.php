@extends('layouts.app')

@section('content')

    <h1>Users</h1>

    <form class="form-inline my-2 my-lg-0" action="/users/user-search" method="PUT">
        <input class="form-control mr-sm-2" name = "search" placeholder="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> <br>
    
    @if(count($users))

        @foreach($users as $user)
        <div class="card">
            <div class="card-body">
                <h5> <a href="/users/{{$user->id}}"> {{$user->name}} </a>

                @if($user->rank == 1)
                    <span class='badge badge-primary p-2'>{{$user->title}}</span>
                @elseif($user->rank == 2)
                    <span class='badge badge-success p-2'>{{$user->title}}</span>
                @elseif($user->rank == 3)
                    <span class='badge badge-info p-2' style="color:#f2f2f2;">{{$user->title}}</span>
                @else
                    <span class='badge badge-secondary p-2'>{{$user->title}}</span>
                @endif

                <?php $diff = Carbon\Carbon::parse($user->created_at)->diffInDays(Carbon\Carbon::now()) ?>

                @if($diff <= 1)
                    <span class='badge badge-dark p-2'>New</span>
                @endif
                </h5>
            </div>
        </div>
        @endforeach
        <br>
        {{$users->render()}} <!-- Pagination -->
    @else
        <p>No Users Found</p>
    @endif
    <br>
@endsection