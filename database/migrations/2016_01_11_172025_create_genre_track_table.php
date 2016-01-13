<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenreTrackTable extends Migration {

	public function up()
	{
		Schema::create('genre_track', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('genre_id')->unsigned();
			$table->integer('track_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('genre_track');
	}
}