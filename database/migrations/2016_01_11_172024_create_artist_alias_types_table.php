<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistAliasTypesTable extends Migration {

	public function up()
	{
		Schema::create('artist_alias_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('artist_alias_types');
	}
}