@extends('layouts.app')

@section('content')
	 <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
			<div class="col-md-2">
				{{ Html::image(URL::route('image.display', $track->release->image), $track->release->name, ['class' => 'img-thumbnail img-responsive']) }}
			</div>
			<div class="col-md-10">
            	<h1>{{ $track->name }} <small>{{ $track->release->name }}</small></h1>
			</div>
        </div>
    </div>
	<div class="container">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2>{{ $track->number }} - {{ $track->name }}{{-- - {{ Html::linkRoute('release.show', $track->release->name, [$track->release->id]) }} --}}
					@can('admin')
						<div class="dropdown  pull-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-wrench"></span>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
								<li>{{ Html::linkRoute('track.edit', trans('htmusic.edit'), ['track' => $track->id]) }}</li>
								<li>{{ Html::linkRoute('track.destroy', trans('htmusic.delete'), ['track' => $track->id], ['data-confirm' => trans('htmusic.are_you_sure'), 'data-token' => csrf_token(),'data-method' => 'DELETE']) }}</li>
								<li role="separator" class="divider"></li>
								<li>{{ Html::linkRoute('link.create', trans('htmusic.add_link'), ['track_id' => $track->id]) }}</li>
								<li>{{ Html::linkRoute('image.create', trans('htmusic.add_image'), ['track_id' => $track->id]) }}</li>
							</ul>
						</div>
					@endcan
					</h2>
				</div>
				<div class="panel-body">
					@if(isset($track->release->name))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.release') }}:</div>
						<div class="col-md-10">{{ Html::linkRoute('release.show', $track->release->name, [$track->release->id]) }}</div>
					</div>
					@endif
					@if(isset($track->length))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.length') }}:</div>
						<div class="col-md-10">{{ gmdate('i:s', $track->length) }}</div>
					</div>
					@endif
					@if(isset($track->notes))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.notes') }}:</div>
						<div class="col-md-10">{{ $track->notes }}</div>
					</div>
					@endif
					@if(isset($track->position))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.position') }}:</div>
						<div class="col-md-10">{{ $track->position }}</div>
					</div>
					@endif
					@if(isset($track->number))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.number') }}:</div>
						<div class="col-md-10">{{ $track->number }}</div>
					</div>
					@endif

					@if(count($track->genres))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.genre') }}:</div>
						<div class="col-md-10">
							@foreach($track->genres as $n => $row)
							{{ $row->name }} @if(isset($track->genres[$n + 1])),@endif
							@endforeach
						</div>
					</div>
					@endif
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.credits') }}</div>
				{{--{{ $track->credit->name }}--}}
				<div class="list-group">
					@forelse ($track->credit->credit_name as $row)
						<a href="{{ route('artist.show', $row->artist->id) }}" class="list-group-item">
							<h4>
								@if($row->join_phrase != '&')<small>{{ $row->join_phrase }}</small>@endif
								{{ $row->artist->name }}
								@if($row->work->name != 'N/A')<small>{{ $row->work->name }}</small>@endif
							</h4>
						</a>
					@empty
						<div class="list-group-item">{{ trans('htmusic.no_credits_found') }}</div>
					@endforelse
				</div>
			</div>

		</div>
		<div class="col-md-6">

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.images') }}</div>
				<div class="panel-body">
					@forelse ($track->images as $row)
						<div class="col-md-3">
							<a href="{{ URL::route('image.show', $row->id) }}">
							{{ Html::image(URL::route('image.display', $row->id), $track->caption, ['class' => 'img-thumbnail img-responsive']) }}
								<div>{{ $artist->caption }}</div>
							</a>
						</div>
					@empty
						<div>{{ trans('htmusic.no_images_found') }}</div>
					@endforelse
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.links') }}</div>

				<div class="list-group">
					@forelse ($track->links as $row)
						<a href="{{ $row->url }}" class="list-group-item" target="_blank" title="{{ $row->description }}">
							{{ $row->caption }}<!-- {{ $row->id }} -->
						</a>
					@empty
						<div class="list-group-item">{{ trans('htmusic.no_links_found') }}</div>
					@endforelse
				</div>
			</div>

		</div>
	</div>

	<script type="text/javascript">
		$(function () {

		});
	</script>
@stop