<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model {

	protected $table = 'user_role';
	public $timestamps = true;

	public function user()
	{
		return $this->belongsToMany('\User', 'user_id');
	}

	public function role()
	{
		return $this->belongsToMany('\Role', 'role_id');
	}

}