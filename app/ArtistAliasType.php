<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ArtistAliasType extends Model {

	protected $table = 'artist_alias_types';
	public $timestamps = true;
	protected $fillable = array('name');

	public function artist_aliases()
	{
		return $this->belongsToMany('App\ArtistAlias','artist_alias_type_id');
	}

}