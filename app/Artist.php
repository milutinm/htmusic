<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model {

	protected $table = 'artists';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'sort_name', 'begin_date', 'is_ended', 'end_date', 'gender', 'bio', 'photo_url');

	public function artistTypes()
	{
		return $this->hasOne('ArtistType');
	}

	public function artistCreditName()
	{
		return $this->hasMany('ArtistCreditName');
	}

	public function aliases()
	{
		return $this->hasMany('ArtistAlias');
	}

}