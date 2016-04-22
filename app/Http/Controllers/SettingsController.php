<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Settings;

class SettingsController extends Controller
{

    protected function create(array $data)
    {
        return Settings::create([
            'nickname' => $data['nickname'],
            'chat_font' => $data['chat_font'],
            'chat_color' => $data['chat_color'],
            'enable_chat' => $data['enable_chat'],

        ]);
    }

    

    
    
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
