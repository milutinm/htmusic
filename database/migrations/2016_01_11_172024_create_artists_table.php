<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtistsTable extends Migration {

	public function up()
	{
		Schema::create('artists', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 100)->index();
			$table->string('sort_name', 100)->index();
			$table->date('begin_date');
			$table->boolean('is_ended');
			$table->date('end_date');
			$table->integer('artist_type_id')->unsigned();
			$table->enum('gender', array('male', 'female', 'other'));
			$table->text('bio');
			$table->timestamps();
			$table->softDeletes();
			$table->string('photo_url', 50);
		});
	}

	public function down()
	{
		Schema::drop('artists');
	}
}