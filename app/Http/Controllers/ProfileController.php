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

    /**
     * @SWG\Get(
     *      path="/api/v1/{userId}",
     *      summary="Retrieves the collection of Profile resources.",
     *      produces={"application/json"},
     *      tags={"Profile"},
     *      @SWG\Response(
     *          response=200,
     *          description="Profiles collection.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/profile")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="Example = Bearer(space)'your_token'",
     *          in="header",
     *          required=true,
     *          type="string",
     *          default="Bearer" 
     *      ),
     *      @SWG\Parameter(
     *          name="userId",
     *          in="path",
     *          description="Please enter the userId",
     *          required=true,
     *          type="integer"
     *      )    
     * )
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

    /**
        * @SWG\Put(
        *   path="/api/v1/{userId}",
        *   summary="Update profile.",
        *   produces={"application/json"},
        *   consumes={"application/json", "multipart/form-data"},
        *   tags={"Profile"},
        *       @SWG\Response(
        *           response=200,
        *           description="Profile updated.",
        *          @SWG\Schema(
        *              type="array",
        *              @SWG\Items(ref="#/definitions/profile")
        *          )
        *       ),
        *       @SWG\Response(
        *           response=401,
        *           description="Unauthorized action."
        *       ),
        *      @SWG\Parameter(
        *          name="Authorization",
        *          description="Example = Bearer(space)'your_token'",
        *          in="header",
        *          required=true,
        *          type="string",
        *          default="Bearer" 
        *      ),
        *      @SWG\Parameter(
        *           name="userId",
        *           in="path",
        *           description="Please enter the userId",
        *           required=true, 
        *           type="integer"
        *      ),
        *      @SWG\Parameter(
        *           name="body",
        *           in="body",
        *           required=true,
        *           description="Update your account here!",
        *           type="string",
        *           @SWG\Schema(
        *               @SWG\Property(
        *                   property="username",
        *                   type="string"
        *               ),
        *               @SWG\Property(
        *                   property="name",
        *                   type="string"
        *               ),
        *               @SWG\Property(
        *                   property="password",
        *                   type="string",
        *                   format="password"
        *               ),
        *               @SWG\Property(
        *                   property="email",
        *                   type="string"
        *               ),   
        *               @SWG\Property(
        *                   property="gender",
        *                   type="boolean"
        *               ),
        *           )
        *      )
        * )
        */ 
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->gender = $request->gender;
        if($request->hasFile('image')){
            if($request->image->isValid()){
                $path = $request->image->store('public/member/' . Auth::user()->id);
                $profile->photo = $path;
            }
        }
        $profile->save();
        $user = $profile->user;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();
        $profile->user()->save($user);

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

    /**
     * @SWG\Post(
     *      path="/api/v1/{userId}/follow",
     *      summary="Follow or Unfollow user.",
     *      produces={"application/json"},
     *      consumes={"application/json"},
     *      tags={"User Follower"},
     *      @SWG\Response(
     *          response=200,
     *          description="Success.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/user follower")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="User ID not found."
     *      ),
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="Example = Bearer(space)'your_token'",
     *          in="header",
     *          required=true,
     *          type="string",
     *          default="Bearer",
     *      ),
     *      @SWG\Parameter(
     *           name="userId",
     *           in="path",
     *           description="Please enter the userId",
     *           required=true, 
     *           type="integer"
     *      )             
     * )
     */
    public function userDoFollow($id)
    {
        $checkUserLogin = Auth::id();
        $checkUserAvailable = Profile::where('id', $id)->count();
        $checkIfFollow = UserFollower::where('user_id', Auth::id())->where('follow_id', $id)->count();
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
                    $userFollower->user_id = Auth::id();
                    $userFollower->follow_id = $id;
                    $userFollower->save();
                    
                    return response()->json(['messages' => 'Success'], 200);
                
                }else
                {
                    $userFollower = UserFollower::where('user_id', Auth::id())
                                          ->where('follow_id', $id)
                                          ->delete();

                    return response()->json(['messages' => 'Success'], 200);                      
                                          
                }
            }
            
        }else 
        {
            return response()->json(['messages' => 'User ID not found'], 404);
        }

    }

    /**
     * @SWG\Get(
     *      path="/api/v1/{userId}/followers",
     *      summary="Show total followers by User's Id.",
     *      produces={"application/json"},
     *      tags={"User Follower"},
     *      @SWG\Response(
     *          response=200,
     *          description="This is the data that you search.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/user follower")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="User ID not found."
     *      ),
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="Example = Bearer(space)'your_token'",
     *          in="header",
     *          required=true,
     *          type="string",
     *          default="Bearer",
     *      ),
     *      @SWG\Parameter(
     *           name="userId",
     *           description="Please enter the userId",
     *           in="path",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */
    public function followers($id) 
    {
        $checkUserAvailable = Profile::where('id', $id)->count();
        if($checkUserAvailable != 0) {
            $follower = Profile::select('name')
                            ->leftJoin('user_followers', 'profiles.id', 'user_followers.user_id')
                            ->where('user_followers.follow_id', $id)
                            ->get();

            return $follower;
        }else {
            return response()->json(['messages' => 'User ID not found'], 404);
        } 
         
    }

    /**
     * @SWG\Get(
     *      path="/api/v1/{userId}/following",
     *      summary="Show total following by User's Id.",
     *      produces={"application/json"},
     *      tags={"User Follower"},
     *      @SWG\Response(
     *          response=200,
     *          description="This is the data that you search.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/user follower")
     *          )
     *      ),
     *      @SWG\Response(
     *          response=401,
     *          description="Unauthorized action."
     *      ),
     *      @SWG\Response(
     *          response=404,
     *          description="User ID not found."
     *      ),
     *      @SWG\Parameter(
     *          name="Authorization",
     *          description="Example = Bearer(space)'your_token'",
     *          in="header",
     *          required=true,
     *          type="string",
     *          default="Bearer",
     *      ),
     *      @SWG\Parameter(
     *           name="userId",
     *           description="Please enter the userId",
     *           in="path",
     *           required=true, 
     *           type="integer"
     *      )              
     * )
     */
    public function following($id) 
    {
        $checkUserAvailable = Profile::where('id', $id)->count();
        if($checkUserAvailable != 0) {
            $following = Profile::select('name')
                            ->leftJoin('user_followers', 'profiles.id', 'user_followers.follow_id')
                            ->where('user_followers.user_id', $id)
                            ->get();

            return $following;
        }else {
            return response()->json(['messages' => 'User ID not found'], 404);
        } 
    }
}
