<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistImageTable extends Migration {

	public function up()
	{
		Schema::create('artist_image', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('artist_id')->unsigned()->index();
			$table->integer('image_id')->unsigned()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('artist_image');
	}
}