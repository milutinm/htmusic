<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageTrack extends Model {

	protected $table = 'image_track';
	public $timestamps = true;

	protected $fillable = array('track_id', 'image_id');
}