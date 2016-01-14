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

	public function tracks() {
		return $this->hasMany('App\Track','release_id');
	}

	public function releaseStatus()
	{
		return $this->belongsTo('App\ReleaseStatus');
	}

	public function releaseTypes()
	{
		return $this->belongsTo('App\ReleaseType');
	}

	public function medium()
	{
		return $this->belongsTo('App\Medium');
	}

	public function credit()
	{
		return $this->belongsTo('App\ArtistCredit','artist_credit_id');
	}

	public function label()
	{
		return $this->hasManyThrough('App\Label', 'LabelRelease');
	}

	public function genres()
	{
		return $this->hasManyThrough('App\Genre', 'GenreRelease');
	}
}