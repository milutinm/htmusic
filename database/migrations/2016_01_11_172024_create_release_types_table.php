<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReleaseTypesTable extends Migration {

	public function up()
	{
		Schema::create('release_types', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 30)->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('release_types');
	}
}