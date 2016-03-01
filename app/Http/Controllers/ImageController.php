<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Image;
use App\ArtistImage;
use App\ImageRelease;
use App\ImageTrack;
use App\Release;
use App\Track;
use Storage;

use Gate;
use Request;

use App\Http\Requests\ImageRequest;

class ImageController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
	  /*
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
			  echo storage_path('images/'.$row->path).' not found<hr />'.PHP_EOL;
		  }

	  }

	  return $images;
	  */
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $out	= [
		  'form_route' => [
			  'route'		=> 'image.store',
			  'method'		=> 'POST',
			  'class'		=> 'form-horizontal',
			  'files'		=> true,
		  ]
	  ];

	  if (count(Request::old())) {
		  $rq				= Request::old();
		  $out['image']	= new Image($rq);

		  if (isset($rq['artist_id']) && is_array($rq['artist_id'])) {
			  $out['image']->artists	= Artist::whereIn('id',$rq['artist_id'])->get();
		  }
		  if (isset($rq['release_id']) && is_array($rq['release_id'])) {
			  $out['image']->releases	= Release::whereIn('id',$rq['release_id'])->get();
		  }
		  if (isset($rq['track_id']) && is_array($rq['track_id'])) {
			  $out['image']->tracks	= Track::whereIn('id',$rq['track_id'])->get();
		  }
	  } else {
		  $out['image']	= new Image;
	  }


	  return view('images.form',$out);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(ImageRequest $request)
  {
	  $this->validate($request, [
		  'file'	=> 'required_without:source',
		  'source'	=> 'required_without:file',
	  ]);

	  $rq	= $request->all();


	  if ($request->hasFile('file')) {
		  $rq['mime']	= $request->file('file')->getMimeType();
		  $rq['ext']	= $request->file('file')->guessExtension();
	  }

	  $image				= Image::create($rq);

	  if (isset($rq['artist_id']) && is_array($rq['artist_id'])) {
		  $rq['artist_id']	= array_unique($rq['artist_id'],SORT_NUMERIC);
		  foreach ($rq['artist_id'] as $aid) {
			  $image_a	= ArtistImage::create(['artist_id' => $aid, 'image_id' => $image->id]);
		  }
	  }

	  if (isset($rq['release_id']) && is_array($rq['release_id'])) {
		  $rq['release_id']	= array_unique($rq['release_id'],SORT_NUMERIC);
		  foreach ($rq['release_id'] as $rid) {
			  $image_r	= ImageRelease::create(['release_id' => $rid, 'image_id' => $image->id]);
		  }
	  }

	  if (isset($rq['track_id']) && is_array($rq['track_id'])) {
		  $rq['track_id']	= array_unique($rq['track_id'],SORT_NUMERIC);
		  foreach ($rq['track_id'] as $tid) {
			  $image_t	= ImageTrack::create(['track_id' => $tid, 'image_id' => $image->id]);
		  }
	  }

	  if ($request->hasFile('file')) {
		  $request->file('file')->move(storage_path('images/'.$image->dir), $image->file_name);

		  list($image->width,$image->height)	= getimagesize(storage_path('images/'.$image->path));
	  } elseif ($rq['source']) {
		  $image->ext	= array_pop((explode('.',$rq['source'])));

		  Storage::disk('images')->put($image->path,@file_get_contents($rq['source']));
		  list($image->width,$image->height)	= getimagesize(storage_path('images/'.$image->path));

		  if (Storage::disk('images')->size($image->path) > 0) {
			  $image_info		= getimagesize(storage_path('images/'.$image->path));
			  $image->width		= $image_info[0];
			  $image->height	= $image_info[1];
			  $image->mime		= $image_info['mime'];
		  } else {
			  $image->ext		= 'err';
		  }
	  }

	  $image->save();

	  return redirect()->route('image.show',['image' => $image->id])->with('alert-success', [trans('htmusic.saved')]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
	  $out['image']	= Image::findOrFail($id);

	  return view('images.show', $out);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $out	= [
		  'form_route' => [
			  'route'	=> [
				  'image.update',
				  $id
			  ],
			  'method'	=> 'PUT',
			  'class'		=> 'form-horizontal',
			  'files'		=> true,
		  ]
	  ];

	  if (count(Request::old())) {
		  $rq				= Request::old();
		  $out['image']	= new Image($rq);

		  if (isset($rq['artist_id']) && is_array($rq['artist_id'])) {
			  $out['image']->artists	= Artist::whereIn('id',$rq['artist_id'])->get();
		  }
		  if (isset($rq['release_id']) && is_array($rq['release_id'])) {
			  $out['image']->releases	= Release::whereIn('id',$rq['release_id'])->get();
		  }
		  if (isset($rq['track_id']) && is_array($rq['track_id'])) {
			  $out['image']->tracks = Track::whereIn('id', $rq['track_id'])->get();
		  }
	  } else {
		  $out['image']	= Image::findOrNew($id);
	  }

	  return view('images.form',$out);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(ImageRequest $request,$id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $rq	= $request->all();

	  $image	= Image::findOrFail($id);

	  if ($request->hasFile('file')) {
		  $rq['mime']	= $request->file('file')->getMimeType();
		  $rq['ext']	= $request->file('file')->guessExtension();
	  }

	  $link_a_a	= [];
	  if (isset($rq['artist_id']) && is_array($rq['artist_id'])) {
		  $rq['artist_id']	= array_unique($rq['artist_id'],SORT_NUMERIC);
		  foreach ($rq['artist_id'] as $aid) {
			  $link_a	= ArtistImage::create(['artist_id' => $aid, 'image_id' => $id]);
			  $link_a_a[]	= $link_a->id;
		  }
	  }
	  ArtistImage::where('image_id',$id)->whereNotIn('id',$link_a_a)->delete();

	  $link_r_a	= [];
	  if (isset($rq['release_id']) && is_array($rq['release_id'])) {
		  $rq['release_id']	= array_unique($rq['release_id'],SORT_NUMERIC);
		  foreach ($rq['release_id'] as $rid) {
			  $link_r	= ImageRelease::create(['release_id' => $rid, 'image_id' => $id]);
			  $link_r_a[]	= $link_r->id;
		  }
	  }
	  ImageRelease::where('image_id',$id)->whereNotIn('id',$link_r_a)->delete();

	  $link_t_a	= [];
	  if (isset($rq['track_id']) && is_array($rq['track_id'])) {
		  $rq['track_id']	= array_unique($rq['track_id'],SORT_NUMERIC);
		  foreach ($rq['track_id'] as $tid) {
			  $link_t	= ImageTrack::create(['track_id' => $tid, 'image_id' => $id]);
			  $link_t_a[]	= $link_t->id;
		  }
	  }
	  ImageTrack::where('image_id',$id)->whereNotIn('id',$link_t_a)->delete();


	  if ($request->hasFile('file')) {
		  $request->file('file')->move(storage_path('images/'.$image->dir), $image->file_name);

		  list($image->width,$image->height)	= getimagesize(storage_path('images/'.$image->path));

		  $image->source	= '';
	  } elseif ($rq->source != '') {
		  $image->ext	= array_pop(explode('.',$rq->source));

		  Storage::disk('images')->put($image->path,@file_get_contents($rq->source));
		  list($image->width,$image->height)	= getimagesize(storage_path('images/'.$image->path));

		  if (Storage::disk('images')->size($image->path) > 0) {
			  $image_info		= getimagesize(storage_path('images/'.$image->path));
			  $image->width		= $image_info[0];
			  $image->height	= $image_info[1];
			  $image->mime		= $image_info['mime'];
		  } else {
			  $image->ext		= 'err';
		  }
	  }

	  $image->save();

	  return redirect()->route('image.show',['link' => $id])->with('alert-success', [trans('htmusic.saved')]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $image	= Image::findOrFail($id);

	  ImageRelease::where('image_id',$id)->delete();
	  ImageTrack::where('image_id',$id)->delete();
	  ArtistImage::where('image_id',$id)->delete();

	  if(Storage::disk('images')->has($image->path)) {
		  Storage::disk('images')->delete($image->path);
	  }

	  $image->delete();

	  return redirect()->route('home.index')->with('alert-success', [trans('htmusic.deleted')]);
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