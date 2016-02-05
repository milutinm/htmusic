<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinksTable extends Migration {

	public function up()
	{
		Schema::create('links', function(Blueprint $table) {
			$table->increments('id');
			$table->string('url', 250);
			$table->string('caption', 150);
			$table->text('description');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('links');
	}
}