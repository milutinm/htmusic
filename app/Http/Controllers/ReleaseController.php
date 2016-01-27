<?php

namespace App\Http\Controllers;

use App\ArtistCredit;
use App\Release;
use App\Medium;
use App\ReleaseStatus;
use App\ReleaseType;
use App\WorkType;
use App\ArtistCreditName;
use App\Artist;
use App\Http\Requests\ReleaseRequest;
use Gate;
use Request;

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
			  'route'	=> 'release.store',
			  'method'	=> 'POST',
			  'class'	=> 'form-horizontal'
		  ],
		  'artist_credit'	=> [],
	  ];

	  $out['release']			= Release::findOrNew(0);
	  $out['medium_types']		= Medium::lists('name','id');
	  $out['release_status']	= ReleaseStatus::lists('name','id');
	  $out['release_type']		= ReleaseType::lists('name','id');



	  if (count(Request::old())) {
		  $old	= Request::old();

		  if(isset($old['artist_credit']['id']))
			  foreach ($old['artist_credit']['id'] as $n => $ac_id) {
			  $out['artist_credit'][$n]	= ArtistCreditName::find($ac_id);
			  $out['artist_credit'][$n]['work_type_id']	= $old['artist_credit']['work'][$n];
		  }

		  $out['work_type']		= WorkType::all();
	  } elseif((int)Request::get('artist_id') > 0) {
		  $out['artist_credit'][0]	= ArtistCreditName::where('artist_id',Request::get('artist_id'))->first();
		  $out['work_type']		= WorkType::all();
	  }

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

	  $artists_credit	= ArtistCredit::create(['name' => 'tmp_name', 'artist_count' => 0, 'ref_count' => 0]);
	  $req		= $request->all();	// Request data

	  $ac		= []; // list of ArtistCreditNames
	  $artists	= []; // List of artists, just for counting

	  foreach($req['artist_credit']['work'] as $n => $work_id) {
		  $artist_id	= $req['artist_credit']['id'][$n];
		  $artists[$artist_id]	= Artist::find($artist_id)->name; // artiat counter

		  // Creating new ArtistCreditName
		  $ac_new	= [
			  'artist_credit_id'	=> $artists_credit->id,
			  'artist_id'			=> $artist_id,
			  'work_type_id'		=> $work_id,
			  'position'			=> '',
			  'name'				=> Artist::find($artist_id)->name,
			  'join_phrase'			=> '&',
		  ];

		  $ac[$artist_id.'_'.$work_id]	= new ArtistCreditName($ac_new);

		  // Sets position. Not important for now there is no ordering in form
		  // TODO make ordering in form
		  $ac[$artist_id.'_'.$work_id]->position = $n;
		  // Saving ArtistCreditNames
		  $ac[$artist_id.'_'.$work_id]->save();
	  }

	  $artists_credit->artist_count	= count($artists);
	  $artists_credit->ref_count	= count($ac);
	  $artists_credit->name			= implode(' & ',$artists);
	  $artists_credit->save();

	  $req['artist_credit_id']		= $artists_credit->id;

	  $artist = Release::create($req);

	  return redirect()->route('release.show',['release' => $artist->id])->with('alert-success', [trans('htmusic.saved')]);
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

	  if(Request::ajax()) {
		  $out['credit']				= $out['release']->credit;
		  $out['credit']['credit_name']	= $out['credit']->credit_name;
		  $out['work_type']				= WorkType::orderBy('id')->get(['id','name']);
		  return $out;
	  }

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
	  $out['release_type']		= ReleaseType::lists('name','id');
	  $out['work_type']			= WorkType::all();


	  if (count(Request::old())) {
		  $old	= Request::old();
		  if(isset($old['artist_credit']['id']))
			  foreach ($old['artist_credit']['id'] as $n => $ac_id) {
			  $out['artist_credit'][$n]	= ArtistCreditName::find($ac_id);
			  $out['artist_credit'][$n]['work_type_id']	= $old['artist_credit']['work'][$n];
		  }
	  } else {
		  $out['artist_credit']	= $out['release']->credit->credit_name;
	  }

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

	  $release	= Release::find($id); // Old track data
	  $req		= $request->all();	// Request data

	  $ac		= []; // list of ArtistCreditNames
	  $ac_old	= []; // List of artist credit names that already exist
	  $artists	= []; // List of artists, just for counting

	  foreach($req['artist_credit']['work'] as $n => $work_id) {
		  $artist_id	= $req['artist_credit']['id'][$n];
		  $artists[$artist_id]	= Artist::find($artist_id)->name; // artiat counter

		  // Checking if ArtistCreditName already exists
		  $ac[$artist_id.'_'.$work_id]	= ArtistCreditName::where('work_type_id',(int)$work_id)
			  ->where('artist_id',$artist_id)
			  ->where('artist_credit_id',$release->credit->id)
			  ->first();
		  if ($ac[$artist_id.'_'.$work_id] == null) {
			  // Creating new ArtistCreditName
			  $ac_new	= [
				  'artist_credit_id'	=> $release->credit->id,
				  'artist_id'			=> $artist_id,
				  'work_type_id'		=> $work_id,
				  'position'			=> '',
				  'name'				=> Artist::find($artist_id)->name,
				  'join_phrase'			=> '&',
			  ];

			  $ac[$artist_id.'_'.$work_id]	= new ArtistCreditName($ac_new);
		  }
		  // Sets position. Not important for now there is no ordering in form
		  // TODO make ordering in form
		  $ac[$artist_id.'_'.$work_id]->position = $n;
		  // Saving ArtistCreditNames
		  $ac[$artist_id.'_'.$work_id]->save();

		  // preventing deleting of used ArtistCreditNAmes
		  $ac_old[] = $ac[$artist_id.'_'.$work_id]->id;
	  }

	  // Delete not used ArtistCreditNames
	  ArtistCreditName::where('artist_credit_id',$release->credit->id)->whereNotIn('id', $ac_old)->delete();

	  $release->credit->artist_count	= count($artists);
	  $release->credit->ref_count		= count($ac);
	  $release->credit->name			= implode(' & ',$artists);
	  $release->credit->save();

	  // Saving track data
	  $release->update($req);

	  // Redirect back to Show with message
	  return redirect()->route('release.show',['release' => $id])->with('alert-success', [trans('htmusic.saved')]);

//	  Release::find($id)->update($request->all());
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

	  return redirect()->route('release.index')->with('alert-success', [trans('htmusic.deleted')]);
  }

	public function search($str){
		$out	= Release::where('name','LIKE',$str.'%')->get(['id','name','artist_credit_id']);

		foreach($out as &$row) {
			$row->artist = $row->credit()->first()->name;
		}

		return $out;
	}
  
}