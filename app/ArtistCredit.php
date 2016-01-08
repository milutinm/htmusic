<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistCredit extends Model {

	protected $table = 'artist_credit';
	public $timestamps = true;
	protected $fillable = array('artist_count');

	public function tracks()
	{
		return $this->belongsToMany('Track');
	}

	public function release()
	{
		return $this->belongsToMany('Release');
	}

}