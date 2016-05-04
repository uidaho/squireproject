<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Http\Request;

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

        return view('profile.friends', ['user' => Auth::user()]);
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

        return view('profile.projects', ['user' => Auth::user()]);
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

        return view('profile.comments', ['user' => Auth::user()]);
    }

    public function editView($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        return view('profile.edit', ['user' => $user]);
    }

    public function editViewDefault()
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        if (Auth::guest()) {
            return redirect('/login');
        }

        $user = Auth::user();

		$picture = $request->file('picture');

		if ($picture)
		{
			$newEntry = [
				'date_of_birth' => $request['date_of_birth'],
				'first_name' => $request['first_name'], 
				'last_name' => $request['last_name'], 
				'picture' => $user->username . '.jpg', 
				'phone' => $request['phone'],
				'address' => $request['address'],
				'gender' => $request['gender'], 
				'biography' => $request['biography']
		    ];

        
			$picture->move(base_path() . '/public/images/users',  $user->username . '.jpg');
		}

		else
		{
			$newEntry = [
				'date_of_birth' => $request['date_of_birth'],
				'first_name' => $request['first_name'], 
				'last_name' => $request['last_name'], 
				'picture' => $user->profile->picture, 
				'phone' => $request['phone'],
				'address' => $request['address'],
				'gender' => $request['gender'], 
				'biography' => $request['biography']
		    ];
		}
	
        $user->profile->update($newEntry);

        return redirect('/profile/' . $user->username);
    }

}
