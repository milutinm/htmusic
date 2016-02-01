<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImagesTable extends Migration {

	public function up()
	{
		Schema::create('images', function(Blueprint $table) {
			$table->increments('id');
			$table->string('caption', 64)->index();
			$table->string('description', 250)->index();
			$table->string('ext', 4)->index();
			$table->string('mime_type', 30);
			$table->integer('width')->unsigned();
			$table->integer('height')->unsigned();
			$table->string('source');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('images');
	}
}