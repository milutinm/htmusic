<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseStatus extends Model {

	protected $table = 'release_status';
	public $timestamps = true;
	protected $fillable = array('name');

}