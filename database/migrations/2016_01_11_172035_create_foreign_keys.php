<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('artists', function(Blueprint $table) {
			$table->foreign('artist_type_id')->references('id')->on('artist_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('artist_aliases', function(Blueprint $table) {
			$table->foreign('artist_id')->references('id')->on('artists')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('artist_aliases', function(Blueprint $table) {
			$table->foreign('artis_alias_type_id')->references('id')->on('artist_alias_types')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('releases', function(Blueprint $table) {
			$table->foreign('artist_credit_id')->references('id')->on('artist_credit')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('releases', function(Blueprint $table) {
			$table->foreign('medium_id')->references('id')->on('mediums')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('releases', function(Blueprint $table) {
			$table->foreign('release_status_id')->references('id')->on('release_status')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('label_release', function(Blueprint $table) {
			$table->foreign('release_id')->references('id')->on('releases')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('label_release', function(Blueprint $table) {
			$table->foreign('label_id')->references('id')->on('labels')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('tracks', function(Blueprint $table) {
			$table->foreign('release_id')->references('id')->on('releases')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('tracks', function(Blueprint $table) {
			$table->foreign('artist_credit_id')->references('id')->on('artist_credit')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('genre_release', function(Blueprint $table) {
			$table->foreign('genre_id')->references('id')->on('genres')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('genre_release', function(Blueprint $table) {
			$table->foreign('release_id')->references('id')->on('releases')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('artist_credit_name', function(Blueprint $table) {
			$table->foreign('artist_credit_id')->references('id')->on('artist_credit')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('artist_credit_name', function(Blueprint $table) {
			$table->foreign('artist_id')->references('id')->on('artists')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('artist_credit_name', function(Blueprint $table) {
			$table->foreign('work_type_id')->references('id')->on('work_type')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('genre_track', function(Blueprint $table) {
			$table->foreign('genre_id')->references('id')->on('genres')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('genre_track', function(Blueprint $table) {
			$table->foreign('track_id')->references('id')->on('tracks')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('artists', function(Blueprint $table) {
			$table->dropForeign('artists_artist_type_id_foreign');
		});
		Schema::table('artist_aliases', function(Blueprint $table) {
			$table->dropForeign('artist_aliases_artist_id_foreign');
		});
		Schema::table('artist_aliases', function(Blueprint $table) {
			$table->dropForeign('artist_aliases_artis_alias_type_id_foreign');
		});
		Schema::table('releases', function(Blueprint $table) {
			$table->dropForeign('releases_artist_credit_id_foreign');
		});
		Schema::table('releases', function(Blueprint $table) {
			$table->dropForeign('releases_medium_id_foreign');
		});
		Schema::table('releases', function(Blueprint $table) {
			$table->dropForeign('releases_release_status_id_foreign');
		});
		Schema::table('label_release', function(Blueprint $table) {
			$table->dropForeign('label_release_release_id_foreign');
		});
		Schema::table('label_release', function(Blueprint $table) {
			$table->dropForeign('label_release_label_id_foreign');
		});
		Schema::table('tracks', function(Blueprint $table) {
			$table->dropForeign('tracks_release_id_foreign');
		});
		Schema::table('tracks', function(Blueprint $table) {
			$table->dropForeign('tracks_artist_credit_id_foreign');
		});
		Schema::table('genre_release', function(Blueprint $table) {
			$table->dropForeign('genre_release_genre_id_foreign');
		});
		Schema::table('genre_release', function(Blueprint $table) {
			$table->dropForeign('genre_release_release_id_foreign');
		});
		Schema::table('artist_credit_name', function(Blueprint $table) {
			$table->dropForeign('artist_credit_name_artist_credit_id_foreign');
		});
		Schema::table('artist_credit_name', function(Blueprint $table) {
			$table->dropForeign('artist_credit_name_artist_id_foreign');
		});
		Schema::table('artist_credit_name', function(Blueprint $table) {
			$table->dropForeign('artist_credit_name_work_type_id_foreign');
		});
		Schema::table('genre_track', function(Blueprint $table) {
			$table->dropForeign('genre_track_genre_id_foreign');
		});
		Schema::table('genre_track', function(Blueprint $table) {
			$table->dropForeign('genre_track_track_id_foreign');
		});
	}
}