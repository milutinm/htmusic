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

	public function links() {
		return $this->belongsToMany('App\Link');
	}
}