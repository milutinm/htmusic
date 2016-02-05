<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {

	protected $table = 'links';
	public $timestamps = true;
	protected $fillable = array('url', 'embed', 'caption', 'description', 'target', 'template');

	public function artists()
	{
		return $this->belongsToMany('App\Artist');
	}

	public function tracks()
	{
		return $this->belongsToMany('App\Track');
	}

	public function releases()
	{
		return $this->belongsToMany('App\Release');
	}

}