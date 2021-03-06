<?php

namespace App\Http\Controllers;

use App\Artist;
use App\ArtistCredit;
use App\Http\Requests\TrackRequest;
use App\Release;
use App\Track;
use App\WorkType;
use App\ArtistCreditName;
use App\Genre;
use App\GenreTrack;
use Illuminate\Support\Facades\Route;
use Gate;
use Request;

class TrackController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
	  $out['tracks']	= Track::orderBy('name')->paginate(20);

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
			  'route'	=> 'track.store',
			  'method'	=> 'POST',
			  'class'	=> 'form-horizontal'
		  ],
		  'artist_credit'	=> [],
	  ];

	  if (count(Request::old())) {
		  $old	= Request::old();

		  if (isset($old['release_id'])) {
			  $out['release']		= Release::find($old['release_id']);
		  }

		  if(isset($old['artist_credit']['id']))
			  foreach ($old['artist_credit']['id'] as $n => $ac_id) {
				  $artist = Artist::where('id',$ac_id)->firstOrFail();
				  if (count($artist)) {
					  $out['artist_credit'][$n]['name']	= $artist->name;
					  $out['artist_credit'][$n]['work_type_id']	= $old['artist_credit']['work'][$n];
					  $out['artist_credit'][$n]['join_phrase']	= $old['artist_credit']['join'][$n];
					  $out['artist_credit'][$n]['artist_id']	= $old['artist_credit']['id'][$n];
				  }
			  }


	  } elseif((int)Request::get('release_id') > 0) {
		  $out['release']	=  Release::find((int)Request::get('release_id'));
		  $out['artist_credit']	= $out['release']->credit->credit_name;

	  }

	  $out['work_type']		= WorkType::all();
	  $out['track']			= Track::findOrNew(0);
	  $out['genre']			= Genre::orderBy('id')->lists('name','id');
	  $out['genres_selected']	= [];

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

	  $artists_credit	= ArtistCredit::create(['name' => 'tmp_name', 'artist_count' => 0, 'ref_count' => 0]);
	  $req		= $request->all();	// Request data

	  $ac		= []; // list of ArtistCreditNames
	  $artists	= []; // List of artists, just for counting

	  foreach($req['artist_credit']['work'] as $n => $work_id) {
		  $artist_id	= $req['artist_credit']['id'][$n];
		  $join_phrase  = $req['artist_credit']['join'][$n];
		  $artists[$artist_id]	= $join_phrase.' '.Artist::find($artist_id)->name; // artiat counter

		  // Creating new ArtistCreditName
		  $ac_new	= [
			  'artist_credit_id'	=> $artists_credit->id,
			  'artist_id'			=> $artist_id,
			  'work_type_id'		=> $work_id,
			  'position'			=> '',
			  'name'				=> Artist::find($artist_id)->name,
			  'join_phrase'			=> $join_phrase,
		  ];

		  $ac[$artist_id.'_'.$work_id.'_'.$join_phrase]	= new ArtistCreditName($ac_new);

		  // Sets position. Not important for now there is no ordering in form
		  // TODO make ordering in form
		  $ac[$artist_id.'_'.$work_id.'_'.$join_phrase]->position = $n;
		  // Saving ArtistCreditNames
		  $ac[$artist_id.'_'.$work_id.'_'.$join_phrase]->save();
	  }
	  
	  $artists_credit->artist_count	= count($artists);
	  $artists_credit->ref_count	= count($ac);
	  $artists_credit->name			= trim(implode(' ',$artists),' &');
	  $artists_credit->save();

	  $req['artist_credit_id']		= $artists_credit->id;

	  $track = Track::create($req);

	  $genre		= []; // genre list
	  foreach($req['genre'] as $n => $genre_id){
		  $genre_new	= [
			  'genre_id'	=> $genre_id,
			  'track_id'	=> $track->id,
		  ];
		  $genre[$n] = new GenreTrack($genre_new);
		  $genre[$n]->save();
	  }

//	  return;
	  return redirect()->route('track.show',['track' => $track->id])->with('alert-success', [trans('htmusic.saved')]);
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
	  $out['genre']			= Genre::orderBy('id')->lists('name','id');

	  if (count(Request::old())) {
		  $old	= Request::old();

		  $out['release']		= Release::find($old['release_id']);
		  if(isset($old['artist_credit']['id']))
			  foreach ($old['artist_credit']['id'] as $n => $ac_id) {
				  $artist = Artist::where('id',$ac_id)->firstOrFail();
				  if (count($artist)) {
					  $out['artist_credit'][$n]['name']	= $artist->name;
					  $out['artist_credit'][$n]['work_type_id']	= $old['artist_credit']['work'][$n];
					  $out['artist_credit'][$n]['join_phrase']	= $old['artist_credit']['join'][$n];
					  $out['artist_credit'][$n]['artist_id']	= $old['artist_credit']['id'][$n];
				  }
			  }
	  } else {
		  $out['release']		= $out['track']->release;
		  $out['artist_credit']	= $out['track']->credit->credit_name;
	  }
	  $out['work_type']		= WorkType::all();


	  $out['genres_selected']	= [];
	  foreach ($out['track']->genres as $row) {
		  $out['genres_selected'][]	= $row->id;
	  }

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

	  $track		= Track::find($id); // Old track data
	  $req			= $request->all();	// Request data


	  $genre		= []; // genre list
	  $genre_old	= []; // genre list

	  foreach($req['genre'] as $n => $genre_id){
		  $genre[$n]	= GenreTrack::where('track_id',$id)->where('genre_id', $genre_id)->first();
		  if ($genre[$n] == null) {
			  $genre_new	= [
				  'genre_id'	=> $genre_id,
				  'track_id'	=> $id,
			  ];
			  $genre[$n] = new GenreTrack($genre_new);
			  $genre[$n]->save();
		  }
		  $genre_old[]	= $genre[$n]->id;
	  }
	  GenreTrack::where('track_id',$id)->whereNotIn('id', $genre_old)->delete();


	  $ac			= []; // list of ArtistCreditNames
	  $ac_old		= []; // List of artist credit names that already exist
	  $artists		= []; // List of artists, just for counting

	  foreach($req['artist_credit']['work'] as $n => $work_id) {
		  $artist_id	= $req['artist_credit']['id'][$n];
		  $join_phrase  = $req['artist_credit']['join'][$n];
		  $artists[$artist_id]	= $join_phrase.' '.Artist::find($artist_id)->name; // artiat counter

		  // Checking if ArtistCreditName already exists
		  $ac[$artist_id.'_'.$work_id.'_'.$join_phrase]	= ArtistCreditName::where('work_type_id',(int)$work_id)
			  ->where('artist_id',$artist_id)
			  ->where('join_phrase',$join_phrase)
			  ->where('artist_credit_id',$track->credit->id)
			  ->first();
		  if ($ac[$artist_id.'_'.$work_id.'_'.$join_phrase] == null) {
			  // Creating new ArtistCreditName
			  $ac_new	= [
				  'artist_credit_id'	=> $track->credit->id,
				  'artist_id'			=> $artist_id,
				  'work_type_id'		=> $work_id,
				  'position'			=> '',
				  'name'				=> Artist::find($artist_id)->name,
				  'join_phrase'			=> $join_phrase,
			  ];

			  $ac[$artist_id.'_'.$work_id.'_'.$join_phrase]	= new ArtistCreditName($ac_new);
		  }
		  // Sets position. Not important for now there is no ordering in form
		  // TODO make ordering in form
		  $ac[$artist_id.'_'.$work_id.'_'.$join_phrase]->position = $n;
		  // Saving ArtistCreditNames
		  $ac[$artist_id.'_'.$work_id.'_'.$join_phrase]->save();

		  // preventing deleting of used ArtistCreditNAmes
		  $ac_old[] = $ac[$artist_id.'_'.$work_id.'_'.$join_phrase]->id;
	  }

	  // Delete not used ArtistCreditNames
	  ArtistCreditName::where('artist_credit_id',$track->credit->id)->whereNotIn('id', $ac_old)->delete();

	  $track->credit->artist_count	= count($artists);
	  $track->credit->ref_count		= count($ac);
	  $track->credit->name			= trim(implode(' ',$artists),' &');
	  $track->credit->save();

	  // Saving track data
	  $track->update($req);

	  // Redirect back to Show with message
	  return redirect()->route('track.show',['track' => $id])->with('alert-success', [trans('htmusic.saved')]);
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

	  return redirect()->route('track.index')->with('alert-success', [trans('htmusic.deleted')]);
  }

	public function search($str){
		$out	= Track::where('name','LIKE',$str.'%')->get(['id','name','release_id']);

		foreach($out as &$row) {
			$release		= $row->release()->first();
			$row->release	= $release->name;
			$row->artist	= $release->credit()->first()->name;
		}

		return $out;
	}
}
