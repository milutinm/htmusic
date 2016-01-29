<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GenreRelease extends Model {

	protected $table = 'genre_release';
	public $timestamps = true;

	protected $fillable = array('genre_id','release_id');

	public function genre()
	{
		return $this->belongsTo('App\Genre');
	}

	public function release()
	{
		return $this->belongsTo('App\Release');
	}

}