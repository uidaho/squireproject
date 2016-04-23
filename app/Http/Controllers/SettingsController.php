<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD

use App\Http\Requests;

class SettingsController extends Controller
{
=======
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

<<<<<<< HEAD
    

    
    
>>>>>>> 16b05e60849177353837a729893f03a10660946a
    public function editSettings()
=======
    //TO be used in Authentication - whenever a new user is created, call this function
    /*public function initializeSettings()
>>>>>>> 2c32be178e9c2a5b564c7b719b759a7a99bd7ede
    {
        $newEntry = Settings::create([
            'user_id' => Auth::user()->user_id,
            'nickname' => Auth::user()->username,
            'chat_enabled' => 1,
            ]);
    }*/
    
}
