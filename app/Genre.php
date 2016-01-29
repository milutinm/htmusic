<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model {

	protected $table = 'genres';
	public $timestamps = true;
	protected $fillable = array('name');

	public function release()
	{
		return $this->belongsToMany('Release', 'App\GenreRelease');
	}

	public function tracks()
	{
		return $this->belongsToMany('Track', 'App\GenreTrack');
	}

}