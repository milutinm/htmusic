<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistCredit extends Model {

	protected $table = 'artist_credit';
	public $timestamps = true;
	protected $fillable = array('artist_count');

	public function track()
	{
		return $this->hasOne('App\Track','artist_credit_id');
	}

	public function release()
	{
		return $this->hasOne('App\Release','artist_credit_id');
	}

	public function credit_name()
	{
		return $this->hasMany('App\ArtistCreditName','artist_credit_id');
	}
}