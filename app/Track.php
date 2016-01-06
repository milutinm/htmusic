<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model {

	protected $table = 'tracks';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'length', 'notes');

	public function releases()
	{
		return $this->belongsTo('Release');
	}

	public function medium()
	{
		return $this->hasOne('Medium');
	}

}