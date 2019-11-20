@extends('layouts.admin')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Logs
        <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
        <li><a href="/admin-panel"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Logs</li>
        </ol>
    </section>

    <section class="content">
        @if(count($logs))
            <table class="table table-striped text-center">
                <tr>
                    <th>#ID</th>
                    <th>Details</th>
                    <th>Time</th>
                </tr>
            @foreach($logs as $log)
                <tr>
                <td>{{$log->id}}</td>
                <td>{{$log->details}}</td>
                <td>{{$log->created_at}}</td>
                </tr>
            @endforeach
            </table>
            <div class="justify-content-center">
                    {{$logs->links()}} <!-- Pagination -->
            </div>
        @else
            No Logs Available
        @endif
    </section>

@endsection