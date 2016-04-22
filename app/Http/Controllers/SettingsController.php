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

    protected function create(array $data)
    {
        return Settings::create([
            'nickname' => $data['nickname'],
            'chat_font' => $data['chat_font'],
            'chat_color' => $data['chat_color'],
            'enable_chat' => $data['enable_chat'],

        ]);
    }

    

    
    
>>>>>>> 16b05e60849177353837a729893f03a10660946a
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
