<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArtistRequest;
use App\Release;
use App\Medium;
use App\ReleaseStatus;

class ReleaseController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
	  $out['releases']	= Release::orderBy('name')->paginate(45);

	  return view('releases.list',$out);
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
			  'release.store',
			  'method'	=> 'PUT',
			  'class'	=> 'form-horizontal'
		  ],
		  'artist_credit'	=> [],
	  ];

	  $out['release']			= Release::findOrNew(0);
	  $out['medium_types']		= Medium::lists('name','id');
	  $out['release_status']	= ReleaseStatus::lists('name','id');

	  return view('releases.form',$out);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return ReleaseRequest
   */
  public function store(ReleaseRequest $request)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $artist = Release::create($request->all());

	  return redirect()->route('release.show',['release' => $artist->id])->with('infos', [trans('htmusic.saved')]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
	  $out['release']	= Release::findOrNew((int)$id);

	  return view('releases.show', $out);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   */
  public function edit($id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $out	= [
		  'form_route' => [
			  'route'	=> [
				  'release.update',
				  $id
			  ],
			  'method'	=> 'PUT',
			  'class'	=> 'form-horizontal'
		  ],
		  'artist_credit'	=> [],
	  ];

	  $out['release']			= Release::findOrNew((int)$id);
	  $out['medium_types']		= Medium::lists('name','id');
	  $out['release_status']	= ReleaseStatus::lists('name','id');

	  return view('releases.form',$out);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return ReleaseRequest
   */
  public function update(ReleaseRequest $request, $id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  Release::find($id)->update($request->all());

	  return redirect()->route('release.show',['release' => $id])->with('infos', [trans('htmusic.saved')]);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   */
  public function destroy(ArtistRequest $request ,$id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  Release::destroy($id);

	  return redirect()->route('release.index')->with('infos', [trans('htmusic.deleted')]);
  }
  
}