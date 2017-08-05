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
    /**
     * @SWG\Get(
     *      path="/api/v1/food/admin",
     *      summary="Retrieves the collection of Admin resources.",
     *      produces={"application/json"},
     *      tags={"Admin"},
     *      @SWG\Response(
     *          response=200,
     *          description="Admins collection.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/admin")
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
     *      )    
     * )
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

      /**
        * @SWG\Post(
        *   path="/api/v1/food/admin",
        *   summary="Register new Admin.",
        *   produces={"application/json"},
        *   consumes={"application/json"},
        *   tags={"Admin"},
        *       @SWG\Response(
        *           response=200,
        *           description="Admin token.",
        *           @SWG\Schema(
        *              type="array",
        *              @SWG\Items(ref="#/definitions/admin")
        *          )
        *       ),
        *       @SWG\Response(
        *           response=401,
        *           description="Unauthorized action."
        *       ),
        *       @SWG\Parameter(
        *           name="body",
        *           in="body",
        *           required=true,
        *           description="Haven't an account? Register here!",
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
        *               @SWG\Property(
        *                   property="address",
        *                   type="string"
        *               ),
        *               @SWG\Property(
        *                   property="phone_no",
        *                   type="string"
        *               ),
        *           )
        *      )
        * )
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
    /**
     * @SWG\Get(
     *      path="/api/v1/food/{adminId}",
     *      summary="Retrieves the collection of Admin resources.",
     *      produces={"application/json"},
     *      tags={"Admin"},
     *      @SWG\Response(
     *          response=200,
     *          description="Admins collection.",
     *          @SWG\Schema(
     *              type="array",
     *              @SWG\Items(ref="#/definitions/admin")
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
     *          name="adminId",
     *          in="path",
     *          description="Please enter the adminId",
     *          required=true,
     *          type="integer"
     *      )    
     * )
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

      /**
        * @SWG\Put(
        *   path="/api/v1/food/{adminId}",
        *   summary="Update admin.",
        *   produces={"application/json"},
        *   consumes={"application/json"},
        *   tags={"Admin"},
        *       @SWG\Response(
        *           response=200,
        *           description="Admin updated.",
        *          @SWG\Schema(
        *              type="array",
        *              @SWG\Items(ref="#/definitions/admin")
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
        *           name="adminId",
        *           in="path",
        *           description="Please enter the adminId",
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
        *               @SWG\Property(
        *                   property="address",
        *                   type="string"
        *               ),
        *               @SWG\Property(
        *                   property="phone_no",
        *                   type="string"
        *               )
        *           )
        *      )
        * )
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
