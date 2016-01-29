<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LabelRelease extends Model {

	protected $table = 'label_release';
	public $timestamps = true;

	protected $fillable = array('label_id','release_id');

	public function release()
	{
		return $this->belongsTo('Release');
	}

	public function label()
	{
		return $this->belongsTo('Label');
	}

}