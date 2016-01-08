<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistCreditName extends Model {

	protected $table = 'artist_credit_name';
	public $timestamps = true;
	protected $fillable = array('name', 'join_phrase');

	public function artist()
	{
		return $this->belongsTo('Artist');
	}

	public function work()
	{
		return $this->hasOne('WorkType');
	}

	public function artist_kredit()
	{
		return $this->hasOne('ArtistCredit');
	}

}