<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'author', 'description', 'body', 'created_at', 'updated_at'
    ];
}
