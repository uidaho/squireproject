<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Renders the Profile view for the given project
     *
     *
     * @return The user's profile page view
     */
    public function view()
    {
        return view('profile.view');
    }

    /**
     * Deletes the given user and all their connected data
     *
     *
     * @return The index page
     */
    public function deleteUser(User $user)
    {
        //Check if user to be deleted is actually the user that is signed in
        /*$this->authorize('userIsOwner', $profile);
        $profile->user->deleteUser();
        */

        $user->deleteUser();

        return view('pages.index');
    }
}

