<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {

	protected $table = 'genres';
	public $timestamps = true;
	protected $fillable = array('name');

	public function release()
	{
		return $this->hasManyThrough('Release', 'GenreRelease');
	}

	public function tracks()
	{
		return $this->hasManyThrough('Track', 'GenreTrack');
	}

}