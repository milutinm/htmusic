<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Release extends Model {

	protected $table = 'releases';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'barcode', 'date', 'notes');

	public function releaseStatus()
	{
		return $this->hasOne('ReleaseStatus');
	}

	public function labels()
	{
		return $this->belongsToMany('App\Label')->withPivot('label_release');
	}

	public function releaseTypes()
	{
		return $this->hasOne('ReleaseType');
	}

	public function medium()
	{
		return $this->hasOne('Medium');
	}

	public function genres()
	{
		return $this->belongsToMany('App\Genre')->withPivot('genre_release');
	}

}