<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SettingsController extends Controller
{
    public function editSettings()
    {
        if (Auth::user()->guest)
        {
            return redirect(login);
        }

        else
        {
            openSettings(Auth::user()->id);
        }
    }


    public function openSettings(&$string)
    {

    }
    
    public function applyChanges()

    {

    }

}
