<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medium extends Model {

	protected $table = 'mediums';
	public $timestamps = true;
	protected $fillable = array('name');

}