<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Settings;

class SettingsController extends Controller
{

    
    //DO we need this? What's the difference between this and the next function?
    protected function create(array $data)
    {
        return Settings::create([
            'user_id' => $data['user_id'],
            'nickname' => $data['nickname'],
            'enable_chat' => 1,

        ]);
    }
    
    
    
    //TO be used in Authentication - whenever a new user is created, call this function
    /*public function initializeSettings()

    {
        $newEntry = Settings::create([
            'user_id' => Auth::user()->user_id,
            'nickname' => Auth::user()->username,
            'chat_enabled' => 1,
            ]);
    }*/
    
}
