<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model {

	protected $table = 'artists';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'sort_name', 'begin_date', 'is_ended', 'end_date', 'gender', 'bio', 'photo_url', 'artist_type_id');

	public function type()
	{
		return $this->belongsTo('App\ArtistType','artist_type_id','id');
	}
///*
	public function credit_name()
	{
		return $this->hasMany('App\ArtistCreditName');
	}
//*/
	public function aliases()
	{
		return $this->hasMany('App\ArtistAlias','artist_id','id');
	}

	public function releases() {
		return $this->hasMany('App\ArtistCreditName');
	}
}