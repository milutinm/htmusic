<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistCreditTable extends Migration {

	public function up()
	{
		Schema::create('artist_credit', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->integer('artist_count')->unsigned();
			$table->integer('ref_count')->unsigned();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('artist_credit');
	}
}