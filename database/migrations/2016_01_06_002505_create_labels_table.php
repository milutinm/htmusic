<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLabelsTable extends Migration {

	public function up()
	{
		Schema::create('labels', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name', 50);
			$table->date('begin_date');
			$table->date('is_ended');
			$table->date('end_date');
			$table->text('description');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('labels');
	}
}