@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header"> {{$header}} </div>
        <div class="card-body">
            @if(count($shows))
            <table class="table table-striped">
                <tr class="text-center">
                    <th> # </th>
                    <th> Info </th>
                    <th> Rating </th>
                    <th> Watch Count </th>
                </tr>

                @foreach ($shows as $index => $show) 
                    <tr>
                        <td class="text-center"> {{$index + $shows->firstItem() }}</td>
                        <td>
                            <div class="row">
                                <img src="/storage/cover_images/{{$show->cover_image}}" height="80" width="60">
                                <div class="col">
                                    <a href="shows/{{$show->id}}"> <h5>{{$show->name}}</h5> </a>
                                    <small> Premiere Date : {{$show->premiere_date}} </small> <br>
                                    <small>Episodes : {{$show->episodes}}</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            <img src="/storage/icons/star.png">
                            <div class="mt-2">
                                <small style="font-size:15px;">{{$show->rating}}</small>
                            </div>
                        </td>
                        <td class="text-center">
                            <img src="/storage/icons/watching-tv.png">
                            <div class="mt-2">
                                <small style="font-size:15px;">{{$show->watch_count}}</small>
                            </div>
                        </td>
                    <tr>  
                @endforeach
            </table>
            <br>
            {{$shows->links()}}
            @else
                Nothing to show
            @endif
        </div>
        <div class="card-footer"></div>
    </div>
@endsection