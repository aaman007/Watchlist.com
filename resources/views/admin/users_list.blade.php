@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         Users
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Users</li>
        </ol>
    </section>

    <section class="content">
            @if(count($users))
                <table class="table table-striped text-center">
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                @foreach($users as $user)
                    <tr>
                    <td>{{$user->name}}</td>
                    <td>
                        @if($user->rank == 1)
                            <span class='label label-primary p-2'>{{$user->title}}</span>
                        @elseif($user->rank == 2)
                            <span class='label label-success p-2'>{{$user->title}}</span>
                        @elseif($user->rank == 3)
                            <span class='label label-info p-2'>{{$user->title}}</span>
                        @else
                            <span class='label label-default p-2'>{{$user->title}}</span>
                        @endif
                    </td>
                    <td>
                        @if(Auth::user()->id != $user->id)
                            <a href="/admin-panel/users/{{$user->id}}" class="btn btn-info"> View</a>
                        @endif

                        @if($user->rank - Auth::user()->rank > 1)
                            <a href="/admin-panel/users/promote/{{$user->id}}" class="btn btn-warning"> Promote</a>
                        @endif
                        @if($user->rank - Auth::user()->rank > 0 && $user->role == 'Admin')
                            <a href="/admin-panel/users/demote/{{$user->id}}" class="btn btn-danger"> Demote</a>
                        @endif
                    </td>
                    </tr>
                @endforeach
                </table>
                {{$users->links()}} <!-- Pagination -->
            @else
                No Users
            @endif
        </section>

@endsection