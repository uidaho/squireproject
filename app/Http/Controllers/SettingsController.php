<?php

namespace App\Http\Controllers;

use App\User;
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

    public function update(Request $request)
    {
        $settings = Settings::where('user_id', Auth::user()->id);
        $settings->nickname = $request->get('nickname');

        $settings->save();

        Session::flash('succes', 'Update settings');
        return redirect('/settings');
        dd($settings);
    }
    
    
    //Check all settings are enabled using a loop when a user logs on
    public function getSetting($setting)
    {
        switch ($setting)
        {
            case 'enable_chat':
                $this->getEnableChat();
                break;
            default:
                    pass;
        }
    }


    //Paired with the getSetting() function to set settings to the given value
    public function setSetting($setting, $value)
    {
        switch ($setting)
        {
            case 'enable_chat':
                Auth::user()->enable_chat = $value;
                break;
            default:
                    pass;
        }


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
