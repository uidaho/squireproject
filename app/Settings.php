<?php

namespace App\providers;



class Settings extends Model
{
    protected $fillable = [
            'nickname', 'chat_font', 'chat_color', 'enable_chat',
    ];
}
