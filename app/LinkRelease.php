<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LinkRelease extends Model {

	protected $table = 'link_release';
	public $timestamps = true;
	protected $fillable = array('release_id', 'link_id');

}