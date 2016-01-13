<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreTrack extends Model {

	protected $table = 'genre_track';
	public $timestamps = true;

	public function track()
	{
		return $this->belongsTo('Track');
	}

	public function genre()
	{
		return $this->belongsTo('Genre');
	}

}