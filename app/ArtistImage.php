<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistImage extends Model {

	protected $table = 'artist_image';
	public $timestamps = true;

	protected $fillable = array('artist_id', 'image_id');

}