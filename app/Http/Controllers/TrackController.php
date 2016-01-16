<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackRequest;
use App\Track;
use Illuminate\Support\Facades\Route;

class TrackController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
	  $out['tracks']	= Track::orderBy('name')->paginate(45);

	  return view('tracks.list',$out);
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
			  'track.store',
			  'method'	=> 'PUT',
			  'class'	=> 'form-horizontal'
		  ],
		  'artist_credit'	=> [],
	  ];

	  $out['track']			= Track::findOrNew(0);

	  return view('tracks.form',$out);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(TrackRequest $request)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $track = Track::create($request->all());

	  return redirect()->route('track.show',['track' => $track->id])->with('infos', [trans('htmusic.saved')]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
	  $out['track']	= Track::findOrNew((int)$id);

	  return view('tracks.show', $out);
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
				  'track.update',
				  $id
			  ],
			  'method'	=> 'PUT',
			  'class'	=> 'form-horizontal'
		  ],
		  'artist_credit'	=> [],
	  ];

	  $out['track']			= Track::findOrNew((int)$id);

	  return view('tracks.form',$out);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(TrackRequest $request, $id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  Track::find($id)->update($request->all());

	  return redirect()->route('track.show',['track' => $id])->with('infos', [trans('htmusic.saved')]);
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

	  Track::destroy($id);

	  return redirect()->route('track.index')->with('infos', [trans('htmusic.deleted')]);
  }
  
}
