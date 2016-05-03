<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $table = 'user_profiles';
    protected $fillable = ['date_of_birth', 'gender', 'biography', 'first_name', 'last_name','profile_url','phone','address','created_at', 'updated_at'];

	public function user()
    {
        return $this->belongsTo(User::class);
    }

}
