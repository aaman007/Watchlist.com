<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Log;
use App\Statistic;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name','asc')->paginate(10);
        return view('users.index')->with('users',$users);
    }
    public function search()
    {
        $search = $_GET['search'];
        $users = User::where('name',$search)->orWhere('name','like',$search.'%')->orderBy('name','asc')->paginate(10);
        return view('users.index')->with('users',$users);
    }
    public function update_details()
    {
        $user = User::find(auth()->user()->id);
        return view('users.update_details')->with('user',$user);
    }
    public function profile()
    {
        $user = auth()->user();
        $watching = Statistic::where('user_id',$user->id)->where('status','Watching')->count();
        $completed = Statistic::where('user_id',$user->id)->where('status','Completed')->count();
        $planToWatch = Statistic::where('user_id',$user->id)->where('status','Plan To Watch')->count();
        $onHold = Statistic::where('user_id',$user->id)->where('status','On Hold')->count();
        $dropped = Statistic::where('user_id',$user->id)->where('status','deopped')->count();
        $data = array(
            'user' => $user,
            'watching' => $watching,
            'completed' => $completed,
            'onHold' => $onHold,
            'dropped' => $dropped,
            'planToWatch' => $planToWatch
        );
        return view('users.profile')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $watching = Statistic::where('user_id',$user->id)->where('status','Watching')->count();
        $completed = Statistic::where('user_id',$user->id)->where('status','Completed')->count();
        $planToWatch = Statistic::where('user_id',$user->id)->where('status','Plan To Watch')->count();
        $onHold = Statistic::where('user_id',$user->id)->where('status','On Hold')->count();
        $dropped = Statistic::where('user_id',$user->id)->where('status','deopped')->count();
        $data = array(
            'user' => $user,
            'watching' => $watching,
            'completed' => $completed,
            'onHold' => $onHold,
            'dropped' => $dropped,
            'planToWatch' => $planToWatch
        );
        if(auth()->guest() || auth()->id() != $user->id)
            return view('users.user_profile')->with($data);
        else
            return redirect('/profile');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'currentPassword' => 'required',
            'newPassword' => 'nullable|min:8',
            'profile_picture' => 'image|nullable|max:1999'
        ]);

        $user = User::find($id);
        $currentPassword = $request->input('currentPassword');
        $newPassword = $request->input('newPassword');

        if(Hash::check($currentPassword,$user->password)){
            $user->name = $request->input('name');

            if($newPassword != '')
                $user->password = Hash::make($newPassword);

            if($request->input('gender') != "Select")
                $user->gender = $request->input('gender');

            $user->city = $request->input('city');
            $user->country = $request->input('country');

            // Handle file upload
            if($request->hasFile('profile_picture')){

                // Get filename with extention
                $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();

                // Get filename
                $filename = pathinfo($filenameWithExt,PATHINFO_FILENAME);

                // Get Extension
                $extension = $request->file('profile_picture')->getClientOriginalExtension();

                $filenameToStore = $filename . "_" . time() . "." . $extension;

                // Upload Image
                $path = $request->file('profile_picture')->storeAs('public/profile_pictures',$filenameToStore);
            }
            if($request->hasFile('profile_picture')){
                if($user->profile_picture != 'noimage.jpg')
                    Storage::delete('public/profile_pictures/'.$user->profile_picture);
                $user->profile_picture = $filenameToStore;
            }

            $user->save();

            // Insertion of Log
            $log = new Log;
            $log->details = auth()->user()->name . " updated his profile details";
            $log->save();

            return redirect('/update-details')->with('success','Profile Updated');
        }
        else
            return redirect('/update-details')->with('error','Wrong Current Password');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
