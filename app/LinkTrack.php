<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkTrack extends Model {

	protected $table = 'link_track';
	public $timestamps = true;
	protected $fillable = array('track_id', 'link_id');

}