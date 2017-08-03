<?php

namespace App\Http\Controllers;

use App\Profile;
use App\UserFollower;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $profile = Profile::with('user')->findOrFail($id);
        $profile->max_exp = $profile->level * 250;
        $profile->user->load('post');
        return $profile;

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
        //
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
        //
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

    public function userDoFollow($id)
    {
        $checkUserLogin = Auth::id();
        $checkUserAvailable = Profile::where('id', $id)->count();
        $checkIfFollow = UserFollower::where('user_id', $id)->where('follower_id', Auth::id())->count();
        if($checkUserAvailable != 0) 
        {
            if($checkUserLogin == $id)
            {
                echo "kok follow id sendiri??";
            }else 
            {
                if($checkIfFollow == 0)
                {
                    $userFollower = new UserFollower();
                    $userFollower->user_id = $id;
                    $userFollower->follower_id = Auth::id();
                    $userFollower->save();
                    
                    return response()->json(['messages' => 'Success'], 200);
                
                }else
                {
                    $userFollower = UserFollower::where('user_id', $id)
                                          ->where('follower_id', Auth::id())
                                          ->delete();

                    return response()->json(['messages' => 'Success'], 200);                      
                                          
                }
            }
            
        }else 
        {
            return response()->json(['messages' => 'User ID not found'], 404);
        }

    }

    public function followers($id){
        $profile = Profile::with('user')->findOrFail($id);
        $followers = UserFollower::where('user_id', Auth::id())->get();

        return response()->json($followers->toArray()); 
    }

    public function following($id){
        $profile = Profile::with('user')->findOrFail($id);
        $following = UserFollower::where('follower_id', Auth::id())->get();
        
        return response()->json($following->toArray()); 
    }
}
