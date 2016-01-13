<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistAliasesTable extends Migration {

	public function up()
	{
		Schema::create('artist_aliases', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('artist_id')->unsigned();
			$table->string('name', 50)->index();
			$table->string('sort_name', 50)->index();
			$table->integer('artis_alias_type_id')->unsigned()->index();
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