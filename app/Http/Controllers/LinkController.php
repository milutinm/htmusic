<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Link;
use App\LinkRelease;
use App\LinkTrack;
use App\ArtistLink;
use App\Http\Requests\LinkRequest;

use App\Artist;
use App\Release;
use App\Track;

use Gate;
use Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$out['links']	= Link::orderBy('caption')->paginate(45);

		return view('links.list',$out);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		if(Gate::denies('admin')) {
			abort(403);
		}

		// TODO "Add Link" button

		$out	= [
			'form_route' => [
				'route'		=> 'link.store',
				'method'	=> 'POST',
				'class'		=> 'form-horizontal'
			]
		];

		if (count(Request::old())) {
			$rq				= Request::old();
			$out['link']	= new Link($rq);

			if (isset($rq['artist_id']) && is_array($rq['artist_id'])) {
				$out['link']->artists	= Artist::whereIn('id',$rq['artist_id'])->get();
			}
			if (isset($rq['release_id']) && is_array($rq['release_id'])) {
				$out['link']->releases	= Release::whereIn('id',$rq['release_id'])->get();
			}
			if (isset($rq['track_id']) && is_array($rq['track_id'])) {
				$out['link']->tracks	= Track::whereIn('id',$rq['track_id'])->get();
			}
		} else {
			$rq			= Request::all(['artist_id','release_id','track_id']);

			$out['link']	= new Link;

			if (isset($rq['artist_id']) && (int)$rq['artist_id'] > 0) {
				$out['link']->artists	= Artist::where('id',(int)$rq['artist_id'])->get();
			}
			if (isset($rq['release_id']) && (int)$rq['release_id'] > 0) {
				$out['link']->releases	= Release::where('id',(int)$rq['release_id'])->get();
			}
			if (isset($rq['track_id']) && (int)$rq['track_id'] > 0) {
				$out['link']->tracks	= Track::where('id',(int)$rq['track_id'])->get();
			}
		}

		return view('links.form',$out);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LinkRequest $request)
    {
		$rq	= $request->all();

		$link				= Link::create($rq);

		if (isset($rq['artist_id']) && is_array($rq['artist_id'])) {
			$rq['artist_id']	= array_unique($rq['artist_id'],SORT_NUMERIC);
			foreach ($rq['artist_id'] as $aid) {
				$link_a	= ArtistLink::create(['artist_id' => $aid, 'link_id' => $link->id]);
			}
		}

		if (isset($rq['release_id']) && is_array($rq['release_id'])) {
			$rq['release_id']	= array_unique($rq['release_id'],SORT_NUMERIC);
			foreach ($rq['release_id'] as $rid) {
				$link_r	= LinkRelease::create(['release_id' => $rid, 'link_id' => $link->id]);
			}
		}

		if (isset($rq['track_id']) && is_array($rq['track_id'])) {
			$rq['track_id']	= array_unique($rq['track_id'],SORT_NUMERIC);
			foreach ($rq['track_id'] as $tid) {
				$link_t	= LinkTrack::create(['track_id' => $tid, 'link_id' => $link->id]);
			}
		}

		return redirect()->route('link.show',['link' => $link->id])->with('alert-success', [trans('htmusic.saved')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$out['link']	= Link::findOrFail($id);

		return view('links.show', $out);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		if(Gate::denies('admin')) {
			abort(403);
		}

		$out	= [
			'form_route' => [
				'route'	=> [
					'link.update',
					$id
				],
				'method'	=> 'PUT',
				'class'		=> 'form-horizontal'
			]
		];

		if (count(Request::old())) {
			$rq				= Request::old();
			$out['link']	= new Link($rq);

			if (isset($rq['artist_id']) && is_array($rq['artist_id'])) {
				$out['link']->artists	= Artist::whereIn('id',$rq['artist_id'])->get();
			}
			if (isset($rq['release_id']) && is_array($rq['release_id'])) {
				$out['link']->releases	= Release::whereIn('id',$rq['release_id'])->get();
			}
			if (isset($rq['track_id']) && is_array($rq['track_id'])) {
				$out['link']->tracks = Track::whereIn('id', $rq['track_id'])->get();
			}
		} else {
			$out['link']	= Link::findOrNew($id);
		}

		return view('links.form',$out);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LinkRequest $request, $id)
    {
		if(Gate::denies('admin')) {
			abort(403);
		}

		$rq	= $request->all();

		Link::find($id)->update($rq);

		$link_a_a	= [];
		if (isset($rq['artist_id']) && is_array($rq['artist_id'])) {
			$rq['artist_id']	= array_unique($rq['artist_id'],SORT_NUMERIC);
			foreach ($rq['artist_id'] as $aid) {
				$link_a	= ArtistLink::create(['artist_id' => $aid, 'link_id' => $id]);
				$link_a_a[]	= $link_a->id;
			}
		}
		ArtistLink::where('link_id',$id)->whereNotIn('id',$link_a_a)->delete();

		$link_r_a	= [];
		if (isset($rq['release_id']) && is_array($rq['release_id'])) {
			$rq['release_id']	= array_unique($rq['release_id'],SORT_NUMERIC);
			foreach ($rq['release_id'] as $rid) {
				$link_r	= LinkRelease::create(['release_id' => $rid, 'link_id' => $id]);
				$link_r_a[]	= $link_r->id;
			}
		}
		LinkRelease::where('link_id',$id)->whereNotIn('id',$link_r_a)->delete();

		$link_t_a	= [];
		if (isset($rq['track_id']) && is_array($rq['track_id'])) {
			$rq['track_id']	= array_unique($rq['track_id'],SORT_NUMERIC);
			foreach ($rq['track_id'] as $tid) {
				$link_t	= LinkTrack::create(['track_id' => $tid, 'link_id' => $id]);
				$link_t_a[]	= $link_t->id;
			}
		}
		LinkTrack::where('link_id',$id)->whereNotIn('id',$link_t_a)->delete();



		return redirect()->route('link.show',['link' => $id])->with('alert-success', [trans('htmusic.saved')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		if(Gate::denies('admin')) {
			abort(403);
		}

		LinkRelease::where('link_id',$id)->delete();
		LinkTrack::where('link_id',$id)->delete();
		ArtistLink::where('link_id',$id)->delete();

		Link::destroy($id);

		return redirect()->route('link.index')->with('alert-success', [trans('htmusic.deleted')]);
    }
}
