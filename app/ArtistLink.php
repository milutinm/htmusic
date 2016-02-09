<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistLink extends Model {

	protected $table = 'artist_link';
	public $timestamps = true;
	protected $fillable = array('artist_id', 'link_id');

}