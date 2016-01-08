<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReleaseType extends Model {

	protected $table = 'release_types';
	public $timestamps = true;
	protected $fillable = array('name');

	public function release()
	{
		return $this->belongsToMany('Release');
	}

}