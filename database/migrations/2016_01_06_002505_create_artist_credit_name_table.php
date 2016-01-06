<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistCreditNameTable extends Migration {

	public function up()
	{
		Schema::create('artist_credit_name', function(Blueprint $table) {
			$table->integer('artist_credit')->unsigned();
			$table->integer('position');
			$table->integer('artist_id')->unsigned();
			$table->string('name');
			$table->string('join_phrase', 10);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('artist_credit_name');
	}
}