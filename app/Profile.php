<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table = 'user_profiles';
    protected $fillable = ['date_of_birth', 'first_name', 'last_name','profile_url','phone','address', 'gender', 'biography', 'created_at', 'updated_at'];

	public function user()
    {
        return $this->belongsTo(User::class);
    }

}
