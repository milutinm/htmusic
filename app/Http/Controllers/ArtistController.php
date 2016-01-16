<?php

namespace App\Http\Controllers;

use \App\ArtistType;
use \App\Artist;
use App\Http\Requests\ArtistRequest;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\Gate;
use Gate;
//use Illuminate\Contracts\Auth\Access\Gate;


class ArtistController extends Controller {

	public function __construct()
	{
//		$this->middleware('web');
	}

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
	  $out['artists']	= Artist::orderBy('sort_name')->paginate(45);

	  return view('artists.list',$out);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
//	  \Illuminate\Support\Facades\Gate::denies('admin');

	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $out	= [
		  'form_route' => [
			  'route'	=> 'artist.store',
			  'method'	=> 'POST',
			  'class'	=> 'form-horizontal'
		  ]
	  ];

	  $out['artist']	= Artist::findOrNew(0);

	  $out['artist_types']	= ArtistType::lists('name','id');

	  return view('artists.form',$out);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(ArtistRequest $request)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  $artist = Artist::create($request->all());

	  return redirect()->route('artist.show',['artist' => $artist->id])->with('infos', [trans('htmusic.saved')]);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
	  $out['artist']	= Artist::findOrNew((int)$id);

	  return view('artists.show', $out);
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
				  'artist.update',
				  $id
			  ],
			  'method'	=> 'PUT',
			  'class'	=> 'form-horizontal'
		  ]
	  ];

	  $out['artist']	= Artist::findOrNew((int)$id);

	  $out['artist_types']	= ArtistType::lists('name','id');

	  return view('artists.form',$out);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(ArtistRequest $request, $id)
  {
	  if(Gate::denies('admin')) {
		  abort(403);
	  }

	  Artist::find($id)->update($request->all());

	  return redirect()->route('artist.show',['artist' => $id])->with('infos', [trans('htmusic.saved')]);
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

	  Artist::destroy($id);

	  return redirect()->route('artist.index')->with('infos', [trans('htmusic.deleted')]);
  }
  
}