<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLinkReleaseTable extends Migration {

	public function up()
	{
		Schema::create('link_release', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('release_id')->unsigned()->index();
			$table->integer('link_id')->unsigned()->index();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('link_release');
	}
}