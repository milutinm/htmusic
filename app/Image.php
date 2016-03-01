<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model {

	protected $table = 'images';
	public $timestamps = true;
	protected $fillable = array('caption', 'description', 'ext', 'mime_type', 'width', 'height', 'source');
	protected $visible = array('id','caption', 'description', 'ext', 'mime_type', 'width', 'height', 'source');

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

	public function scopeRemote($query){
		return $query->where('ext','')->where('source','<>','');
	}

	public function getPathAttribute() {
		$dir	= array_reverse(str_split(str_pad(dechex($this->id),10,0,STR_PAD_LEFT),2));
		array_pop($dir);
		return implode('/',$dir).'/'.str_pad(dechex($this->id),8,0,STR_PAD_LEFT).'.'.$this->ext;
	}

	public function getDirAttribute() {
		return dirname($this->path);
	}

	public function getFileNameAttribute() {
		return str_replace($this->path.'/','',$this->path);
	}

	public function getUrlAttribute() {
		return url(str_replace(base_path(),'',$this->path));
	}
}