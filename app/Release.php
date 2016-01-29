<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Release extends Model {

	protected $table = 'releases';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'barcode', 'date', 'notes', 'artist_credit_id','medium_id','release_status_id','release_type_id');

	public function tracks() {
		return $this->hasMany('App\Track','release_id');
	}

	public function status()
	{
		return $this->belongsTo('App\ReleaseStatus','release_status_id');
	}

	public function type()
	{
		return $this->belongsTo('App\ReleaseType','release_type_id');
	}

	public function medium()
	{
		return $this->belongsTo('App\Medium','medium_id');
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
		return $this->belongsToMany('App\Genre');
	}
}