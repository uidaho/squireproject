<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function profileView($username)
    {
        return view('profile.view', ['username' => $username]);
    }

    public function profileViewDefault()
    {
	if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.view', ['username' => Auth::user()->username]);
    }


    public function friendView($username)
    {
        return view('profile.friends', ['username' => $username]);
    }

    public function friendViewDefault()
    {
	if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.friends', ['username' => Auth::user()->username]);
    }

    public function projectView($username)
    {
        return view('profile.projects', ['username' => $username]);
    }

    public function projectViewDefault()
    {
	if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.projects', ['username' => Auth::user()->username]);
    }

    public function commentsView($username)
    {
        return view('profile.comments', ['username' => $username]);
    }

    public function commentsViewDefault()
    {
	if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.comments', ['username' => Auth::user()->username]);
    }
}
