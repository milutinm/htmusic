<?php

namespace App\Http\Controllers;

use App\ArtistAlias;
use App\Artist;
use App\ArtistAliasType;
use App\Http\Requests\ArtistAliasRequest;
use Gate;
use Request;

class ArtistAliasController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
	  $out['artists']	= ArtistAlias::orderBy('sort_name')->paginate(45);

	  return view('alias.list',$out);
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
			  'route'	=> 'artistalias.store',
			  'method'	=> 'POST',
			  'class'	=> 'form-horizontal'
		  ]
	  ];

	  if (count(Request::old())) {
		  $old	= Request::old();

		  $out['alias']	= (object)Request::old();
		  if (!isset($out['alias']->is_ended)) {
			  $out['alias']->is_ended		= 0;
		  }
		  $out['alias']->artist_id		= $old['artist_id'];
		  $out['alias']->artist_name	= Artist::findOrNew($old['artist_id'])->name;

		  echo '<hr /><pre>'.print_r($out['alias'],1).'</pre><hr />';

	  } elseif((int)Request::get('artist_id') > 0) {
		  $out['alias']	= Artist::findOrNew(Request::get('artist_id'));
		  $out['alias']->artist_id = (int)Request::get('artist_id');
		  $out['alias']->artist_name = $out['alias']->name;
	  } else {
		  $out['alias']	= Artist::findOrNew(0);
	  }

	  $out['alias_types']	= ArtistAliasType::lists('name','id');

	  return view('alias.form',$out);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(ArtistAliasRequest $request)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $artist = ArtistAlias::create($request->all());

	  return redirect()->route('artistalias.show',['artist' => $artist->id])->with('alert-success', [trans('htmusic.saved')]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
	  $out['alias']	= ArtistAlias::findOrNew((int)$id);


	  return view('alias.show', $out);
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
				  'artistalias.update',
				  $id
			  ],
			  'method'	=> 'PUT',
			  'class'	=> 'form-horizontal'
		  ]
	  ];

	  $out['alias']	= ArtistAlias::findOrNew((int)$id);
	  $out['alias']->artist_name	= $out['alias']->artist->name;

	  $out['alias_types']	= ArtistAliasType::lists('name','id');

	  return view('alias.form',$out);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(ArtistAliasRequest $request, $id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  ArtistAlias::find($id)->update($request->all());

	  return redirect()->route('artistalias.show',['artist' => $id])->with('alert-success', [trans('htmusic.saved')]);
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

	  ArtistAlias::destroy($id);

	  return redirect()->route('artistalias.index')->with('alert-success', [trans('htmusic.deleted')]);
  }
  
}

