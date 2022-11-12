<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        //dd($users);
        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$users = User::where('id', auth()->user()->id)->get();
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:6',
            'email' => 'required|unique:users,email',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $data = $request->except('password', 'password_confirmation');
        $data['password'] = Hash::make($request->password);
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }
        $user->fill($data);
        $status = $user->save();
        if($status) {
            return redirect()->route('users.index')->with('success', 'User created successfully.');
        }else{
            return back('error', 'Sorry, there was an error while creating user.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if ($user->id == auth()->user()->id) {
            return view('users.form', compact('user'));
        }else{
            return back()->with('error','You are not authorize to edit.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:6'
        ]);
        $data = $request->except('_token', '_method');
        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $data['image'] = "$profileImage";
        }else{
            unset($data['image']);
        }
        $user->fill($data);
        $status = $user->save();
        if($status) {
            return redirect()->route('users.index')->with('success', 'User updated successfully.');
        }else{
            return back('error', 'Sorry, there was an error while updating user.');
        }
    }

    public function changeProfile()
    {
        $user = User::where('id', auth()->user()->id)->get();
        //dd($user);
        return view('users.change-prof')->with('user', $user);
    }

    public function updateProfile(Request $request, User $user)
    {
        //dd($request->all());
        $request->validate([
                'name' => 'required|min:6',
                'address' => 'required',
                'phone' => 'required'
            ]);
        $data = $request->except('_method','_token');
        $user->fill($data);
        $user->save();
        //dd($user);
        return redirect()->route('users.index')->with("success", "Profile updated successfully!");

    }

    public function changePass(User $user)
    {
        return view('users.change-pass');
    }

    public function updatePassword(Request $request)
    {
        # Validation
        $data = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        #Match The Old Password
        if(!Hash::check($request->old_password, auth()->user()->password)){
            return back()->with("error", "Old Password Doesn't match!");
        }


        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->id == auth()->user()->id) {
            // The action is authorized...
            $user->delete();
            return redirect()->route('users.index')->with('success','User has been deleted successfully');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to delete');
        }
    }
}
