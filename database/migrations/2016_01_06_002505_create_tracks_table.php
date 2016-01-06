<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTracksTable extends Migration {

	public function up()
	{
		Schema::create('tracks', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 30);
			$table->integer('position')->unsigned();
			$table->integer('number');
			$table->integer('artist_credit_id')->unsigned();
			$table->integer('length');
			$table->string('notes', 50);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('tracks');
	}
}