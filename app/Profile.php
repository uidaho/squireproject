<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table = 'profiles';
    protected $fillable = ['date_of_birth', 'first_name', 'last_name','picture','phone','address', 'gender', 'biography', 'created_at', 'updated_at'];

	public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function getProfileImagePath()
    {
        return '/images/users/' . $this->picture;
    }

}
