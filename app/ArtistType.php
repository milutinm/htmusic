<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistType extends Model {

	protected $table = 'artist_types';
	public $timestamps = true;
	protected $fillable = array('name');

	public function artists()
	{
		return $this->hasMany('Artist');
	}

}