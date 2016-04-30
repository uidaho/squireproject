<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Project extends Model
{
    protected $fillable = [
        'title', 'author', 'user_id', 'description', 'body', 'statement_title', 'statement_body', 'tab_title', 'tab_body', 'created_at', 'updated_at'
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
     * Get the path to the project main image for this project.
     *
     * @return string the path
     */
    public function getProjectImagePath()
    {
        return '/images/projects/product' . $this->id . '.jpg';
    }

    /**
     * Get the path to the banner image for this project.
     *
     * @return string the path
     */
    public function getBannerImagePath()
    {
        return '/images/projects/banner' . $this->id . '.jpg';
    }

    /**
     * Override the default model delete method to include all connected data to the project including comments, requests, members, followers, project image, and banner.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete()
    {
        $this->comments()->delete();
        $this->members()->delete();
        $this->requests()->delete();
        $this->followers()->delete();
        $this->files()->delete();

        $res = parent::delete();

        $imagePath = base_path() . '/public' .$this->getProjectImagePath();
        if (file_exists($imagePath)) {  // Shouldn't be null, let's check for sanity
            unlink($imagePath);
        }

        $bannerPath = base_path() . '/public' .$this->getBannerImagePath();
        if (file_exists($bannerPath)) {  // Shouldn't be null, let's check for sanity
            unlink($bannerPath);
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
            'project-body' => Project::minMaxHelper(100, 65535),
        ];
    }

    private static function minMaxHelper($min, $max) {
        return [
            'min' => $min,
            'max' => $max
        ];
    }

    /**
     * Get the user of this project
     *
     * @return user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the files of this project
     *
     * @return files
     */
    public function files()
    {
        return $this->hasMany(File::class);
    }

    /**
     * Get the comments of this project
     *
     * @return comments
     */
    public function comments()
    {
        return $this->hasMany(ProjectComment::class);
    }

    /**
     * Get the followers of this project
     *
     * @return followers
     */
    public function followers()
    {
        return $this->hasMany(ProjectFollower::class);
    }

    /**
     * Gets the requests for this project
     *
     * @return requests
     */
    public function requests()
    {
        return $this->hasMany(ProjectRequest::class);
    }

    /**
     * Gets members connected to this project
     *
     * @return members
     */
    public function members()
    {
        return $this->hasMany(ProjectMember::class);
    }

    /**
     * Create a new comment for this project
     *
     * @param ProjectComment $comment
     * @return new comment
     */
    public function addComment(ProjectComment $comment)
    {
        $comment->user_id = Auth::id();
        return $this->comments()->save($comment);
    }

    /**
     * Get the count of followers for the project
     *
     * @return int follower count
     */
    public function getFollowerCount()
    {
        return count($this->followers);
    }

    /**
     * Check if user is a follower of this project
     *
     * @param Int $user_id
     * @return boolean
     */
    public function isUserFollower($user_id = null)
    {
        $isFollower = false;

        if ($user_id == null)
            $user_id = Auth::user()->id;

        if ($this->followers()->where('user_id', $user_id)->first() != null)
            $isFollower = true;

        return $isFollower;
    }

    /**
     * Adds a follower to the project
     *
     * @param Int user_id
     * @return new follower object
     */
    public function addFollower($user_id = null)
    {
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
     *  @param Int user_id
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
     * @return count of members
     */
    public function getMemberCount()
    {
        return count($this->members);
    }

    /**
     * Adds a member to the project
     *
     * @param boolean $admin
     * @param Int user_id
     * @return new member
     */
    public function addMember($admin = false, $user_id = null)
    {
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
     * @param Int $user_id
     */
    public function deleteMember($user_id = null)
    {
        if ($user_id == null)
            $user_id = Auth::user()->id;

        $this->members()->where('user_id', $user_id)->first()->delete();
    }

    /**
     * Check if user is a member of this project
     *
     * @return boolean
     */
    public function isUserMember($user_id = null)
    {
        if ($user_id == null)
            $user_id = Auth::user()->id;

        return $this->members()->where('user_id', $user_id)->first();
    }

    /**
     * Adds a membership request by the given user to this project
     *
     * @return new request
     */
    public function addMembershipRequest($user_id = null)
    {
        if ($user_id == null)
            $user_id = Auth::user()->id;

        $membershipRequest = ProjectRequest::create([
            'user_id' => $user_id,
            'project_id' => $this->id
        ]);

        return $this->requests()->save($membershipRequest);
    }

    /**
     * Check if a given user has a membership request pending for this project
     *
     * @return boolean
     */
    public function isMembershipPending($user_id = null)
    {
        if ($user_id == null)
            $user_id = Auth::user()->id;

        return $this->requests()->where('user_id', $user_id)->first();
    }

    /**
     * Deletes a membership request to this project
     *
     */
    public function deleteMembershipRequest($user_id = null)
    {
        //Todo send email to denied user

        if ($user_id == null)
            $user_id = Auth::user()->id;

        $this->requests()->where('user_id', $user_id)->first()->delete();
    }

    /**
     * Gets all admins of this project
     *
     * @return admins
     */
    public function getAdmins()
    {
        return $this->members()->where('admin', 1)->get();
    }

    /**
     * Check if user is an admin of this project
     *
     * @return boolean
     */
    public function isProjectAdmin($user_id = null)
    {
        if ($user_id == null)
            $user_id = Auth::user()->id;

        return $this->members()->where('user_id', $user_id)->first()->admin;
    }

    /**
     * Get the count of admins for the project
     *
     * @return int admin count
     */
    public function getAdminCount()
    {
        return count($this->members()->where('admin', 1)->get());
    }
}
