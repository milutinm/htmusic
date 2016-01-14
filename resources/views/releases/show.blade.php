@extends('layouts.app')

@section('content')
	 <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $release->name }} ({{ Carbon::createFromFormat('Y-m-d',$release->date)->format('Y') }})</h1>
        </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $release->name }} ({{ Html::linkRoute('release.edit', trans('htmusic.edit'), [$release->id]) }})</div>
				<div class="panel-body">
					<div class="row">
						{{--<div class="col-md-2">{{ trans('htmusic.name') }}:</div>--}}
						{{--<div class="col-md-10">{{ $release->name }}</div>--}}
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.note') }}:</div>
						<div class="col-md-10">{{ $release->note }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.barcode') }}:</div>
						<div class="col-md-10">{{ $release->barcode }}</div>
					</div>
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.credits') }}</div>
				<div class="panel-body">
					{{ $release->credit->name }}
{{--					{{ $release->credit->credit_name }}--}}
					@forelse ($release->credit->credit_name as $row)
						<div class="row">
							{{--{{ $row->name }}<br>--}}
							{{ Html::linkRoute('artist.show', $row->artist->name, [$row->artist->id]) }} ({{ $row->work->name }})
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_credits_found') }}</div>
					@endforelse

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.tracks') }}</div>
				<div class="panel-body">
					@forelse ($release->tracks as $row)
						<div class="row">
							{{ Html::linkRoute('track.show', $row->name, [$row->id]) }}
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_tracks_found') }}</div>
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