<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $fillable = [
        'title', 'author', 'user_id', 'description', 'body', 'created_at', 'updated_at'
    ];

    protected $perPage = 16;

    /**
     * Gets this projects url
     *
     * @return string
     */
    public function getSlug()
    {
        return '/project/' . $this->title;
    }

    /**
     * Converts this projects title to a slug friendly version
     *
     * @return mixed
     */
    public function getSlugFriendlyTitle()
    {
        //return str_replace(' ', '-', $this->title);  //deprecated
        return $this->title;
    }

    /**
     * Converts the given slug for a project to its title.
     *
     * @param $slug
     * @return mixed
     */
    public static function getTitleFromSlug($slug)
    {
        //return str_replace('-', ' ', $slug);
        return $slug;
    }


    /**
     * Retrieve the project from the database with the given slug, converting
     * it to its proper title for lookup.
     *
     * @param $slug
     * @return mixed
     */
    public static function fromSlug($slug)
    {
        return (new static)->where('title', $slug);
    }

    /**
     * Retrieves the project from the database with the given <strong>title</strong>.
     *
     * @param $name
     * @return mixed
     */
    public static function fromName($name) {
        return (new static)->where('title', $name);
    }

    /**
     * Get the path to the image for this project.
     *
     * @return string the path
     */
    public function getImagePath()
    {
        return '/images/projects/product' . $this->id . '.jpg';
    }

    /**
     * Override the default model delete method to include deleting the image.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        $res = parent::delete();

        $imagePath = base_path() . '/public' .$this->getImagePath();
        if (file_exists($imagePath)) {  // Shouldn't be null, let's check for sanity
            unlink($imagePath);
        }

        return $res;
    }

    /**
     * Checks if the provided is non-null and authored this project
     *
     * @param $user The user to check (nullable)
     * @return bool if the provided user authored this project
     */
    public function isUserAuthor($user)
    {
        if ($user == null) {
            return false;
        }
        return $user->username == $this->author;
    }

    /**
     * Returns the array of lengths required for the attributes.
     *
     * @return array
     */
    public static function attributeLengths()
    {
        return [
            'title' => Project::minMaxHelper(2, 32),
            'description' => Project::minMaxHelper(10, 75),
            'project-body' => Project::minMaxHelper(100, 65535)
        ];
    }

    private static function minMaxHelper($min, $max) {
        return [
            'min' => $min,
            'max' => $max
        ];
    }

    //Lets Laravel know the comment belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Used for fetching the project's comments
    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }
    //Adds a comment to the project
    public function addComment(ProjectComment $comment)
    {
        $comment->user_id = Auth::id();
        return $this->comments()->save($comment);
    }

    /**
     *
     *
     * @return 
     */
    public function followers()
    {
        return $this->hasMany(ProjectFollower::class);
    }

    /**
     *
     *
     * @return
     */
    public function requests()
    {
        return $this->hasMany(ProjectRequest::class);
    }

    /**
     *
     *
     * @return
     */
    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }

    /**
     * Get the count of followers for the project
     *
     * @return
     */
    public function getFollowerCount()
    {
        return count($this->followers());
    }

    /**
     * Check if user is a follower of this project
     *
     * @return
     */
    public function isUserFollower($user_id = null)
    {
        //Todo authentication checking

        if ($user_id == null)
            $user_id = Auth::user()->id;

        return $this->followers()->where('user_id', $user_id)->first();
    }

    /**
     * Adds a follower to the project
     *
     * @return
     */
    public function addFollower($user_id = null)
    {
        //Todo authentication checking

        if ($user_id == null)
            $user_id = Auth::user()->id;

        $follower = ProjectFollower::create([
            'user_id' => $user_id,
            'project_id' => $this->id
        ]);

        return $this->followers()->save($follower);
    }

    /**
     * Deletes a follower from the project
     *
     * @return
     */
    public function deleteFollower($user_id = null)
    {
        if ($user_id == null)
            $user_id = Auth::user()->id;

        $this->followers()->where('user_id', $user_id)->first()->delete();
    }

    /**
     * Get the count of followers for the project
     *
     * @return
     */
    public function getMemberCount()
    {
        return count($this->members());
    }

    /**
     * Adds a member to the project
     *
     * @return
     */
    public function addMember($admin = false, $user_id = null)
    {
        //Todo authentication checking

        if ($user_id == null)
            $user_id = Auth::user()->id;

        $member = ProjectMember::create([
            'user_id' => $user_id,
            'project_id' => $this->id,
            'admin' => $admin
        ]);

        return $this->members()->save($member);
    }

    /**
     * Deletes a member from the project
     *
     * @return
     */
    public function deleteMember($user_id = null)
    {
        //Todo authentication checking

        if ($user_id == null)
            $user_id = Auth::user()->id;

        $this->members()->where('user_id', $user_id)->first()->delete();
    }

    /**
     * Check if user is a member of this project
     *
     * @return
     */
    public function isUserMember($user_id = null)
    {
        //Todo authentication checking

        if ($user_id == null)
            $user_id = Auth::user()->id;

        return $this->members()->where('user_id', $user_id)->first();
    }

    /**
     * Adds a follower to the project
     *
     * @return
     */
    public function addMembershipRequest($user_id = null)
    {
        //Todo authentication checking

        if ($user_id == null)
            $user_id = Auth::user()->id;

        $membershipRequest = ProjectRequest::create([
            'user_id' => $user_id,
            'project_id' => $this->id
        ]);

        return $this->requests()->save($membershipRequest);
    }

    /**
     * Check if user is a follower of this project
     *
     * @return
     */
    public function isMembershipPending($user_id = null)
    {
        //Todo authentication checking

        if ($user_id == null)
            $user_id = Auth::user()->id;

        return $this->requests()->where('user_id', $user_id)->first();
    }

    /**
     * Deletes a follower to the project
     *
     * @return
     */
    public function deleteMembershipRequest($user_id = null)
    {
        //Todo authentication checking
        //Todo send email to denied user

        $this->requests()->where('user_id', $user_id)->first()->delete();
    }

    /**
     * Gets all admins of this project
     *
     * @return
     */
    public function getAdmins()
    {
        return $this->members()->where('admin', 1)->get();
    }

    /**
     * Check if user is an admin of this project
     *
     * @return
     */
    public function isProjectAdmin($user_id = null)
    {
        if ($user_id == null)
            $user_id = Auth::user()->id;

        //Todo authentication checking

        return $this->members()->where('user_id', $user_id)->first()->admin;
    }

    /**
     * Get the count of admins for the project
     *
     * @return
     */
    public function getAdminCount()
    {
        return count($this->members()->where('admin', 1)->get());
    }
}
