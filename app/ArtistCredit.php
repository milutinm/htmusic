<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistCredit extends Model {

	protected $table = 'artist_credit';
	public $timestamps = true;
	protected $fillable = array('artist_count');

	public function tracks()
	{
		return $this->hasMany('App\Track');
	}

	public function releases()
	{
		return $this->hasMany('App\Release');
	}

}