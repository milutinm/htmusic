<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistCreditName extends Model {

	protected $table = 'artist_credit_name';
	public $timestamps = true;
	protected $fillable = array('name', 'join_phrase');

	public function artist()
	{
		return $this->belongsTo('App\Artist');
	}

	public function work()
	{
		return $this->belongsTo('App\WorkType','work_type_id','id');
	}

	public function credit()
	{
		return $this->belongsTo('App\ArtistCredit','artist_credit_id','id');
	}

}