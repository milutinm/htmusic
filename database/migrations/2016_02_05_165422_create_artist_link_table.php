<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistLinkTable extends Migration {

	public function up()
	{
		Schema::create('artist_link', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('artist_id')->unsigned()->index();
			$table->integer('link_id')->unsigned()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('artist_link');
	}
}