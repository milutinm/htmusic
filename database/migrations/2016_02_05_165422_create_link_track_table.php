<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinkTrackTable extends Migration {

	public function up()
	{
		Schema::create('link_track', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('track_id')->unsigned()->index();
			$table->integer('link_id')->unsigned()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('link_track');
	}
}