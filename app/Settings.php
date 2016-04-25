<?php

namespace App\providers;

use App\Http\Controllers\SettingsController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;




class Settings extends Model
{
    protected $fillable = [
            'nickname', 'enable_comments',
    ];
    /**
     * Retrieve user settings
     */
    

    public function user()
    {
        return $this->belongsTo(User::class);
    }    

    
    
    //ensure that a user has settings (for when we add more settings), otherwise initialize to default settings
    public function confirmSettings()
    {
        if (SettingsController::getSetting('enable_chat') == null)
        {
            SettingsController::setSetting('enable_chat', 1);
        }
        
        //Add more checks and default values as we add more settings
    }
        
    
}
