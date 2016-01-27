<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReleasesTable extends Migration {

	public function up()
	{
		Schema::create('releases', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('artist_credit_id')->unsigned();
			$table->integer('medium_id')->unsigned();
			$table->integer('release_status_id')->unsigned();
			$table->integer('release_type_id')->unsigned();
			$table->string('name', 50);
			$table->string('barcode', 50);
			$table->date('date');
			$table->text('notes');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('releases');
	}
}