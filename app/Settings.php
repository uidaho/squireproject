<?php

<<<<<<< HEAD
namespace App\providers;
=======
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
>>>>>>> 2c32be178e9c2a5b564c7b719b759a7a99bd7ede



class Settings extends Model
{
<<<<<<< HEAD
    protected $fillable = [
            'nickname', 'chat_font', 'chat_color', 'enable_chat',
    ];
=======
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


    
>>>>>>> 2c32be178e9c2a5b564c7b719b759a7a99bd7ede
}
