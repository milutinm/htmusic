<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateImageReleaseTable extends Migration {

	public function up()
	{
		Schema::create('image_release', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('image_id')->unsigned()->index();
			$table->integer('release_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('image_release');
	}
}