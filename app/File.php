<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['projectname', 'filename', 'type', 'description', 'contents', 'creator', 'parent'];
}
