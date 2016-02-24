<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'HomeController@index');



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/


Route::group(['middleware' => ['web']], function () {
	Route::resource('artist', 'ArtistController');
//	Route::resource('artisttype', 'ArtistTypeController');
	Route::resource('artistalias', 'ArtistAliasController');
	Route::resource('release', 'ReleaseController');
//	Route::resource('releasestatus', 'ReleaseStatusController');
	Route::resource('label', 'LabelController');
//	Route::resource('labelrelease', 'LabelReleaseController');
	Route::resource('track', 'TrackController');
//	Route::resource('releasetype', 'ReleaseTypeController');
//	Route::resource('genrerelease', 'GenreReleaseController');
//	Route::resource('artistcreditname', 'ArtistCreditNameController');
//	Route::resource('artistcredit', 'ArtistCreditController');
//	Route::resource('artistaliastype', 'ArtistAliasTypeController');
//	Route::resource('medium', 'MediumController');
//	Route::resource('genre', 'GenreController');
	Route::resource('image', 'ImageController');
	Route::resource('link', 'LinkController');

	Route::any('artist/search/{str}',['as' => 'artist.search', 'uses' => 'ArtistController@search']);
	Route::any('release/search/{str}',['as' => 'release.search', 'uses' => 'ReleaseController@search']);
	Route::any('label/search/{str}',['as' => 'label.search', 'uses' => 'LabelController@search']);
	Route::any('track/search/{str}',['as' => 'track.search', 'uses' => 'TrackController@search']);

	Route::any('image/display/{img}',['as' => 'image.display', 'uses' => 'ImageController@display']);
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
    Route::get('/', 'HomeController@index');
});


