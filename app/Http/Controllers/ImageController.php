<?php

namespace App\Http\Controllers;

use App\Image;
use Storage;

class ImageController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
	  // Temporary actions to download pictures
	  // no thumb http://konpa.info/cover-300/000000.jpg
	  $images = Image::remote()->limit(15)->get();

	  foreach ($images as &$row) {
		  $row->ext	= array_pop((explode('.',$row->source)));
		  $dirs = dirname($row->path);
		  $dirs	= explode('/',$dirs);
		  $dir	= storage_path('/');

		  Storage::disk('images')->put($row->path,@file_get_contents($row->source));

		  if(Storage::disk('images')->has($row->path)) {
			  if (Storage::disk('images')->size($row->path) > 0) {
				  $image_info	= getimagesize(storage_path('images/'.$row->path));
				  $row->width	= $image_info[0];
				  $row->height	= $image_info[1];
				  $row->mime	= $image_info['mime'];
			  } else {
				  $row->ext		= 'err';
			  }

			  $row->save();
		  } else {
			  echo storage_path('image/'.$row->path).' not found<hr />'.PHP_EOL;
		  }

	  }

	  return $images;
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }

	public function display($id) {
		// https://laracasts.com/discuss/channels/laravel/laravel-file-storage
		// https://laracasts.com/discuss/channels/general-discussion/storage-get-image-as-file
		$image	= Image::find($id);
		if (is_object($image) && Storage::disk('images')->has($image->path)) {
			return response(Storage::disk('images')->get($image->path),200)->header('Content-Type', $image->mime);
		} else {
			return response(Storage::disk('images')->get('image_not_found.png'),200)->header('Content-Type', 'image/png');
		}
	}
}