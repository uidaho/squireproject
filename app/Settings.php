<?php

namespace App\providers;

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

    
}
