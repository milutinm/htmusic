<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGenreReleaseTable extends Migration {

	public function up()
	{
		Schema::create('genre_release', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('genre_id')->unsigned();
			$table->integer('release_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('genre_release');
	}
}