<?php

namespace App\Http\Requests;

use App\Settings;


class CreateSettingsRequest extends Request
{
    
    //if the user isn't logged in, redirect to login page
    public function authorize()
    {
        if (Auth::guest())
        {
            return redirect('/login');
        }
    }

    
    //Ask for an return the enable_chat variable
    public function getEnableChat()
    {
        return $this->input('enable_chat');
    }

    
    
    
}
