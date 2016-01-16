<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

	public function roles()
	{
		return $this->belongsToMany('App\Role','user_role','user_id','role_id');
	}

	public function isAdmin()
	{
		$roles = $this->roles()->getResults();
		foreach ($roles as $role) {
			if ($role->name == 'admin') return true;
		}
		return false;
	}
}
