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
    protected $fillable = ['projectname', 'filename', 'type', 'description', 'contents', 'user_id', 'parent', 'project_id'];
    
    
    /**
     * Get the display name of the creator of a file.
     *
     * @return Response
     */
    public function author() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    /**
     * Get the project name of a file.
     *
     * @return Response
     */
    public function project() {
        return $this->belongsTo('App\Project', 'project_id', 'id');
    }
    
    public static function forProject(Project $project) {
        $files = (new static)->where('projectname', $project->title)->orderBy('filename', 'asc');
        return $files;
    }
    
    /**
     * Show a list of all files in the database.
     *
     * @return Response
     */
    public function index()
    {
        $files = File::all();

        return view('file.index', ['files' => files]);
    }
    
}
