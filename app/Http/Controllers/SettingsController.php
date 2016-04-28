<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;


use App\Http\Requests;
use App\Settings;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Builder;

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
        $settings = Settings::where('user_id', Auth::user()->id)->first();
        $settings->nickname = $request->get('nickname');

        DB::update('update user_settings set enable_chat = $enable_chat where user_id = ?', ['user_id']);

        Session::flash('success', 'Update settings');
        return redirect('/settings');
    }


    //Check all settings are enabled using a loop when a user logs on
    public function getSetting($setting)
    {
        switch ($setting) {
            case 'enable_chat':
                $this->getEnableChat();
                break;
            default:
                pass;
        }
    }


    //Paired with the getSetting() function to set settings to the given value
    public function setSetting($user_id, $enable_chat)
    {
        DB::update('update user_settings set enable_chat = $enable_chat where user_id = ?', [$user_id]);
    }


    public function view()
    {
        if (Auth::guest())
        {
            return redirect('auth.login');
        }

        return view('settings.settings', ['enable_chat' => 1]);
    }


}



