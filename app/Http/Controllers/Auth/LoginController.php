<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


      /**
        * @SWG\Post(
        *   path="/api/v1/login",
        *   summary="Authenticate User.",
        *   produces={"application/json"},
        *   consumes={"application/json"},
        *   tags={"Login"},
        *       @SWG\Response(
        *           response=200,
        *           description="User token.",
        *           @SWG\Property(
        *               property="token",
        *               type="string"
        *               )
        *       ),
        *       @SWG\Response(
        *           response=401,
        *           description="Unauthorized action."
        *       ),
        *       @SWG\Parameter(
        *           name="body",
        *           in="body",
        *           required=true,
        *           description="You need to login first!",
        *           type="string",
        *           @SWG\Schema(
        *               @SWG\Property(
        *                   property="username",
        *                   type="string"
        *               ),
        *               @SWG\Property(
        *                   property="password",
        *                   type="string",
        *                   format="password"
        *               )   
        *           )
        *      )
        * )
        */
    public function authenticate(Request $request)
    {
        // grab credentials from the request
        $credentials = $request->only('username', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));
    }
}
