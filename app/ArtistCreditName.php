<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistCreditName extends Model {

	protected $table = 'artist_credit_name';
	public $timestamps = true;
	protected $fillable = array('join_phrase');

}