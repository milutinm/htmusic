<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageTrackTable extends Migration {

	public function up()
	{
		Schema::create('image_track', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('image_id')->unsigned()->index();
			$table->integer('track_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('image_track');
	}
}