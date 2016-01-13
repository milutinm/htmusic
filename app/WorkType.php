<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkType extends Model {

	protected $table = 'work_type';
	public $timestamps = true;
	protected $fillable = array('name');

	public function credit_name()
	{
		return $this->hasMany('App\ArtistCreditName');
	}

}