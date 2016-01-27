<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistAlias extends Model {

	protected $table = 'artist_aliases';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'sort_name', 'begin_date', 'is_ended', 'end_date', 'artist_id', 'artist_alias_type_id');

	public function artist()
	{
		return $this->belongsTo('App\Artist','artist_id');
	}

	public function type()
	{
		return $this->belongsTo('App\ArtistAliasType','artist_alias_type_id');
	}

}