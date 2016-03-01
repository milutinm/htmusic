<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageRelease extends Model {

	protected $table = 'image_release';
	public $timestamps = true;

	protected $fillable = array('release_id', 'image_id');
}