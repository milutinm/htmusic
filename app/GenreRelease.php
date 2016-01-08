<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreRelease extends Model {

	protected $table = 'genre_release';
	public $timestamps = true;

	public function genre()
	{
		return $this->hasOne('Genre');
	}

	public function release()
	{
		return $this->hasOne('Release');
	}

}