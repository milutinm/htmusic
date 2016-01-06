<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model {

	protected $table = 'labels';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'begin_date', 'is_ended', 'end_date', 'description');

	public function Release()
	{
		return $this->belongsToMany('App\Release')->withPivot('label_release');
	}

}