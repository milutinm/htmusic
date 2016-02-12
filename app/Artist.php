<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Release;

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

//	public function releases() {
//		return $this->hasMany('App\ArtistCreditName');
//	}

	public function images()
	{
		return $this->belongsToMany('App\Image');
	}

	public function links() {
		return $this->belongsToMany('App\Link');
	}

	public function getImageAttribute() {
		$image = $this->images()->first();
		if ($image) {
			return $image;
		}

		// fallback to release image if there is no user image
		foreach ($this->credit_name as $row) {
			if (isset($row->credit->release->images[0])) {
				return $row->credit->release->images[0];
			}
		}

		// fallback to image id = 0 that will show no image thumb
		return ['id' => 0];
	}
}