<?php

namespace App\Http\Controllers;

use App\User;
use App\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = Admin::with("user")->paginate();
        return $admins;
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
        $this->validate($request, [
            'name'     => 'required|max:255',
            'email'    => 'required|email|max:255|unique:admins',
            'password' => 'required|min:6|confirmed',
            'gender'   => 'required'
        ]);
        $user = new User();
        $user->username = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->gender = $request->gender;
        $admin->address = $request->address;
        $admin->phone_no = $request->phone_no;
        $admin->Save();
        $admin->user()->save($user);
        return $admin;
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
        $admin = Admin::findOrFail($id);
        $admin->load('user');
        return $admin;
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
        $admin = Admin::findOrFail($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->gender = $request->gender;
        $admin->address = $request->address;
        $admin->phone_no = $request->phone_no;
        $admin->save();
        $user = $admin->user;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save(); 
        $admin->user()->save($user);
        return $admin;
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
