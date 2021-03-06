<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMediumsTable extends Migration {

	public function up()
	{
		Schema::create('mediums', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name')->unique();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('mediums');
	}
}