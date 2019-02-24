<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Hash;
use File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $users = User::all();
        return view('users.view',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{6,}$/|confirmed',
            'mobile' => 'required|numeric|digits:10',
            'profile_photo' => 'required|mimes:jpeg,jpg,png|max:100',
            'date_of_birth' => 'required',
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $profilePhoto = $request->file('profile_photo');    
        $photoName = uniqid().$profilePhoto->getClientOriginalName(); 
        $profilePhoto->move('dp/',$photoName);  
        $user->profile_photo = '/dp/'.$photoName;
        $user->date_of_birth = $request->date_of_birth;
        $user->password = Hash::make($request->password);
        if ($user->save()){
            Session::flash('success','User registered successfully');
        }else{
            Session::flash('failure','Sorry something went wrong');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userDetails = User::findorfail($id);
        return view('users.user-details',compact('userDetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userDetails = User::findorfail($id);
        return view('users.edit',compact('userDetails'));
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
        $user = User::findorfail($id);
        $this->validate($request, [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id,
            'mobile' => 'required|numeric|digits:10',
            'profile_photo' => 'nullable|mimes:jpeg,jpg,png|max:100',
            'date_of_birth' => 'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $profilePhoto = $request->file('profile_photo');    
        if (!empty($profilePhoto)){
            $this->deleteProfilePhoto($user->profile_photo);
            $photoName = uniqid().$profilePhoto->getClientOriginalName(); 
            $profilePhoto->move('dp/',$photoName);
            $user->profile_photo = '/dp/'.$photoName;
        }
        $user->date_of_birth = $request->date_of_birth;
        if ($user->update()){
            Session::flash('success','User details updated successfully');
        }else{
            Session::flash('failure','Sorry something went wrong');
        }
        return redirect()->back();   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findorfail($id);
        $this->deleteProfilePhoto($user->profile_photo);
        $user->delete();
    }

    public function deleteProfilePhoto($path)
    {
        if (File::exists(public_path().$path)) {
            File::delete(public_path().$path);
        }
    }
}