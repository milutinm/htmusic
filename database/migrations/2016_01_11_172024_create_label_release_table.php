<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabelReleaseTable extends Migration {

	public function up()
	{
		Schema::create('label_release', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('release_id')->unsigned();
			$table->integer('label_id')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('label_release');
	}
}