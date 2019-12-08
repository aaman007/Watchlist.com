@extends('layouts.app')

@section('content')
    <div class="card text-center">
        <h3 class="card-header">Update Details</h3>

        <div class="card-body">
            <form method="POST" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="table table-striped">
                <tr>
                    <th>Name  </th>
                    <th>
                         <input class="form-control" name="name" type="text" value="{{$user->name}}" required>
                    </th>
                </tr>

                <tr>
                    <th>Profile Picture  </th>
                    <th>
                        <input class="form-control p-1" name="profile_picture" type="file">
                    </th>
                </tr>
                
                <tr>
                    <th>Email  </th>
                    <th>
                        <input class="form-control" name="email" type="email" value="{{$user->email}}" disabled>
                    </th>
                </tr>
                <tr>
                    <th>City </th>
                    <th>
                        <input class="form-control" name="city" type="text" value="{{$user->city}}">
                    </th>
                </tr>
                <tr>
                    <th>Country </th>
                    <th>
                        <input class="form-control" name="country" type="text" value="{{$user->country}}">
                    </th>
                </tr>
                <tr>
                    <th>Gender </th>
                    <th>
                        <div class="form-group">
                            <select class="form-control" name="gender">
                                @if($user->gender == null)
                                    <option selected disabled> Select </option>
                                @endif
                                @if($user->gender == "Male")
                                    <option selected>Male</option>
                                @else
                                    <option>Male</option>
                                @endif
                                @if($user->gender == "Female")
                                    <option selected>Female</option>
                                @else
                                    <option>Female</option>
                                @endif
                            </select>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Website </th>
                    <th>
                        <input class="form-control" name="website" type="url" value="{{$user->website}}">
                    </th>
                </tr>
                <tr>
                    <th>Current Password  </th>
                    <th>
                         <input class="form-control" name="currentPassword" type="password" placeholder="" required>
                    </th>
                </tr>
                <tr>
                    <th>New Password  </th>
                    <th>
                        <input class="form-control" name="newPassword" type="password" placeholder="">
                    </th>
                </tr>
            </table>
            <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    You must enter your current password to update the profile
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <h3 class="card-footer"></h3>
    </div>
@endsection