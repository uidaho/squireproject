<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title', 'author', 'description', 'body', 'created_at', 'updated_at'
    ];

    /**
     * Get the path to the image for this project.
     *
     * @return string the path
     */
    public function getImagePath()
    {
        return base_path() . '/public/images/projects/product' . $this->id . '.jpg';
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

        $imagePath = $this->getImagePath();
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
