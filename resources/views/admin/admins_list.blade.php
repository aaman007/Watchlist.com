@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
         Admins
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Admins</li>
        </ol>
    </section>

    <section class="content">
            @if(count($admins))
                <table class="table table-striped text-center">
                    <tr>
                        <th>Name</th>
                        <th>Title</th>
                        <th>Actions</th>
                    </tr>
                @foreach($admins as $admin)
                    <tr>
                    <td>{{$admin->name}}</td>
                    <td>
                        @if($admin->rank == 1)
                            <span class='label label-primary p-2'>{{$admin->title}}</span>
                        @elseif($admin->rank == 2)
                            <span class='label label-success p-2'>{{$admin->title}}</span>
                        @else
                            <span class='label label-info p-2'>{{$admin->title}}</span>
                        @endif
                    </td>
                    <td>
                        @if(Auth::user()->id != $admin->id)
                            <a href="/admin-panel/users/{{$admin->id}}" class="btn btn-info"> View</a>
                        @endif

                        @if($admin->rank - Auth::user()->rank > 1)
                            <a href="/admin-panel/users/promote/{{$admin->id}}" class="btn btn-warning"> Promote</a>
                        @endif
                        @if($admin->rank - Auth::user()->rank > 0 && $admin->role == 'Admin')
                            <a href="/admin-panel/users/demote/{{$admin->id}}" class="btn btn-danger"> Demote</a>
                        @endif
                    </td>
                    </tr>
                @endforeach
                </table>
                <div class="justify-content-center">
                    {{$admins->links()}} <!-- Pagination -->
                </div>

            @else
                No Users
            @endif
        </section>

@endsection