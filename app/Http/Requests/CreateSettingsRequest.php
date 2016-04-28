<?php

namespace App\Http\Requests;

use App\Settings;


class CreateSettingsRequest extends Request
{

    public function rules()
    {
        return [
            enable_chat => 'required',
        ];
    }

}
