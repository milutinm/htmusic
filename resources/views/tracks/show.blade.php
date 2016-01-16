@extends('layouts.app')

@section('content')
	 <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $track->name }}</h1>
        </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2 class="col-md-8">{{ $track->number }} - {{ $track->name }} - {{ Html::linkRoute('release.show', $track->release->name, [$track->release->id]) }}</h2>
					@can('admin')
					<div class="col-md-4">
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
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.release') }}:</div>
						<div class="col-md-10">{{ $track->release->name }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.length') }}:</div>
						<div class="col-md-10">{{ $track->length }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.notes') }}:</div>
						<div class="col-md-10">{{ $track->notes }}</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.credits') }}</div>
				<div class="panel-body">
					{{ $track->credit->name }}
{{--					{{ $track->credit->credit_name }}--}}
					@forelse ($track->credit->credit_name as $row)
						<div class="row">
							{{ Html::linkRoute('artist.show', $row->artist->name, [$row->artist->id]) }} ({{ $row->work->name }})
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_credits_found') }}</div>
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