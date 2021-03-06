<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Profile;

use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

/**
 * Class AuthController
 *
 * The controller responsible for handling all incoming
 * authentication related requests.
 *
 * @author Robert Breckenridge (editor)
 * @author Ben Bolton (editor)
 * @author Brandon Jank (editor)
 *
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = 'projects';
    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|min:6|max:16|alpha_dash|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|max:32|confirmed',
        ]);
    }

    /**
     * Create a new user and connected profile instance after a valid registration.
     *
     * @param  array $data
     * @return User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        $profile = Profile::create([
            'user_id' => $user->id,
            'picture' => "default-avatar.jpg"
        ]);

        $user->profile()->save($profile);

        return $user;
    }
}
