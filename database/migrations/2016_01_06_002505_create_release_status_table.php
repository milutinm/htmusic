<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReleaseStatusTable extends Migration {

	public function up()
	{
		Schema::create('release_status', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('release_status');
	}
}