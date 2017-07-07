<?php

namespace App\Http\Controllers\Auth;

use JWTAuth;
use App\User;
use App\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:profiles',
            'password' => 'required|min:6|confirmed',
            'gender'   => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $fields = [
            'name'     => $data['name'],
            'username' => $data['username'],
            'password' => bcrypt($data['password']),
            'gender'   => $data['gender'],
            'email'    => $data['email'],
        ];
        // if (config('auth.providers.users.field','email') === 'username' && isset($data['username'])) {
        //     $fields['username'] = $data['username'];
        // }
        $user = User::create($fields);
        $profile = Profile::create($fields);
        $profile->user()->save($user);
        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $token = JWTAuth::fromUser($user);
        return response()->json(['token' => $token, 'status' => 'Success']);
    }
}
