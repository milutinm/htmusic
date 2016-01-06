<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {

	protected $table = 'genres';
	public $timestamps = true;
	protected $fillable = array('name');

	public function releases()
	{
		return $this->belongsToMany('App\Release')->withPivot('genre_release');
	}

}