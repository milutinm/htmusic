<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistTypesTable extends Migration {

	public function up()
	{
		Schema::create('artist_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50)->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('artist_types');
	}
}