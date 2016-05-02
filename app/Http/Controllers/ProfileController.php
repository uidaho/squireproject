<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profileView($username)
    {
		$user = User::where('username', $username)->firstOrFail();
        return view('profile.view', ['user' => $user]);
    }

    public function profileViewDefault()
    {
	if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.view', ['user' => Auth::user()]);
    }


    public function friendView($username)
    {
		$user = User::where('username', $username)->firstOrFail();
        return view('profile.friends', ['user' => $user]);
    }

    public function friendViewDefault()
    {
	if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.friends', ['username' => Auth::user()]);
    }

    public function projectView($username)
    {
		$user = User::where('username', $username)->firstOrFail();
        return view('profile.projects', ['user' => $user]);
    }

    public function projectViewDefault()
    {
	if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.projects', ['username' => Auth::user()]);
    }

    public function commentsView($username)
    {
		$user = User::where('username', $username)->firstOrFail();
        return view('profile.comments', ['user' => $user]);
    }

    public function commentsViewDefault()
    {
	if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.comments', ['username' => Auth::user()]);
    }
}
