@extends('layouts.app')

@section('content')
	 <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $track->name }}</h1>
        </div>
    </div>
	<div class="container">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2>{{ $track->number }} - {{ $track->name }} - {{ Html::linkRoute('release.show', $track->release->name, [$track->release->id]) }}</h2>
					@can('admin')
					<div>
						{!! Form::open([
							'method' => 'DELETE',
							'route' => ['track.destroy', $track->id],
							'class'	=> 'navbar-form navbar-right prompt-confirm',
							'msg'	=> trans('htmusic.are_you_sure')
						]) !!}
							{!! Form::submit(trans('htmusic.delete'), ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}

						{!! Form::open([
							'method' => 'GET',
							'route' => ['track.edit', $track->id],
							'class'	=> 'navbar-form navbar-right'
						]) !!}
							{!! Form::submit(trans('htmusic.edit'), ['class' => 'btn btn-primary']) !!}
						{!! Form::close() !!}
					</div>
					@endcan
				</div>
				<div class="panel-body">
					@if(isset($track->release->name))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.release') }}:</div>
						<div class="col-md-10">{{ $track->release->name }}</div>
					</div>
					@endif
					@if(isset($track->length))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.length') }}:</div>
						<div class="col-md-10">{{ $track->length }}</div>
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
				<div class="panel-body">
					{{ $track->credit->name }}
{{--					{{ $track->credit->credit_name }}--}}
					@forelse ($track->credit->credit_name as $row)
						<div class="row">
							{{ $row->join_phrase }} {{ Html::linkRoute('artist.show', $row->artist->name, [$row->artist->id]) }} ({{ $row->work->name }})
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_credits_found') }}</div>
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
							{{ Html::image(URL::route('image.display', $row->id), $track->name, ['class' => 'img-thumbnail img-responsive']) }}
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_images_found') }}</div>
					@endforelse
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.links') }}</div>
				<div class="panel-body">
					@forelse ($track->links as $row)
						<div class="col-md-3">
							{{ Html::link( $row->url, $row->caption, ['target' => '_blank', 'title' => $row->description]) }} ({{ Html::linkRoute('link.show', trans('htmusic.view'), [$row->id])}})
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_links_found') }}</div>
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