<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Settings extends Model
{
    protected $table = 'user_settings';
    protected $fillable = ['nickname', 'enable_chat', 'editor_font_color', 'editor_font', 'user_id'];

    /**
     * @param $user_id
     * makes sure user is authenticated, then if user exists, retrives settings,
     * otherwise it sets default values
     * @return mixed
     */
    public static function getUserSettings($user_id) {
        $default_settings = [
                       'user_id' => $user_id,
                       'nickname' => Auth::user()->username, 
                       'enable_chat' => 1, 
                       'editor_font' => 'Consolas', 
                       'editor_font_color' => 'Black',
                      ];
                      
        if (!Settings::where('user_id', $user_id)->exists()) {
            $settings = Settings::create($default_settings);
        } else {
            $settings = Settings::where('user_id', $user_id)->first();
        }
        
        return $settings;
    }
}
