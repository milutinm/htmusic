<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model {

	protected $table = 'tracks';
	public $timestamps = true;

	use SoftDeletes;

	protected $dates = ['deleted_at'];
	protected $fillable = array('name', 'position','number','length', 'notes','artist_credit_id','release_id');

	public function release()
	{
		return $this->belongsTo('App\Release','release_id');
	}

	public function credit()
	{
		return $this->belongsTo('App\ArtistCredit','artist_credit_id','id');
	}

	public function genres()
	{
		return $this->belongsToMany('App\Genre');
	}

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
		if ($this->release->image) {
			return $this->release->image;
		}

		// fallback to image id = 0 that will show no image thumb
		return ['id' => 0];
	}
}