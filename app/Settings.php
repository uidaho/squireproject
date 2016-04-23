<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;



class Settings extends Model
{
    /**
     * Retrieve user settings
     */

    protected $fillable = [
        'show_comments',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }    


    
}
