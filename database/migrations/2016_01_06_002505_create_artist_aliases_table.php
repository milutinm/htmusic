<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistAliasesTable extends Migration {

	public function up()
	{
		Schema::create('artist_aliases', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('artist_id')->unsigned();
			$table->string('name', 50);
			$table->string('sort_name');
			$table->integer('type_id')->unsigned();
			$table->date('begin_date');
			$table->boolean('is_ended');
			$table->date('end_date');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('artist_aliases');
	}
}