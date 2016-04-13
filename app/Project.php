<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'author', 'description', 'body', 'created_at', 'updated_at'
    ];

    public static function attributeLengths()
    {
        return [
            'title' => Project::minMaxHelper(2, 50),
            'description' => Project::minMaxHelper(10, 100),
            'project-body' => Project::minMaxHelper(100, 65535)
        ];
    }

    private static function minMaxHelper($min, $max) {
        return [
            'min' => $min,
            'max' => $max
        ];
    }
}
