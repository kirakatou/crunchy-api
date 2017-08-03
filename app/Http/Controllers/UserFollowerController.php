<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\UserFollower;
use App\Profile;

class UserFollowerController extends Controller
{
    public function userDoFollow($user_id)
    {
    	$checkUserLogin = Auth::id();
    	$checkUserAvailable = Profile::where('id', $user_id)->count();
    	$checkIfFollow = UserFollower::where('user_id', $user_id)->where('follower_id', Auth::id())->count();
    	if($checkUserAvailable != 0) 
    	{
    		if($checkUserLogin == $user_id)
    		{
    			echo "kok follow id sendiri??";
    		}else 
    		{
    			if($checkIfFollow == 0)
    			{
	    			$userFollower = new UserFollower();
			    	$userFollower->user_id = $user_id;
			    	$userFollower->follower_id = Auth::id();
			    	$userFollower->save();
		    		
			    	return response()->json(['messages' => 'Success'], 200);
		    	
		    	}else
		    	{
		    		$userFollower = UserFollower::where('user_id', $user_id)
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

    // public function showFollowers(){
    // 	$followers = UserFollower::where('user_id', Auth::id())->get();

    // 	return response()->json($followers->toArray());	
    // }

    // public function showFollowing(){
    // 	$following = UserFollower::where('follower_id', Auth::id())->get();
    	
    // 	return response()->json($following->toArray());	
    // }

    // public function userFollowers($user_id){
    // 	$followers = UserFollower::where('user_id', $user_id)->get();
    	
    // 	return response()->json($followers->toArray());	
    // }

    // public function userFollowing($user_id){
    // 	$following = UserFollower::where('follower_id', $user_id)->get();
    	
    // 	return response()->json($following->toArray());		
    // }
}
