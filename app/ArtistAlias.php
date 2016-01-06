<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArtistAlias extends Model {

	protected $table = 'artist_aliases';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'sort_name', 'begin_date', 'is_ended', 'end_date');

	public function artists()
	{
		return $this->belongsTo('Artist');
	}

	public function artistAliasType()
	{
		return $this->hasOne('ArtistAliasType');
	}

}