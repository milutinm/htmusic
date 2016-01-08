@extends('layouts.app')

@section('content')
	 <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $artist->name }}</h1>
            <p>{{ $artist->bio }}</p>
            {{--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>--}}
{{--            <p>{{ Html::linkRoute('artist.edit', trans('htmusic.edit'), [$artist->id], ['class' => 'btn btn-primary btn-lg', 'role' => 'button']) }}</p>--}}
        </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ $artist->name }} ({{ Html::linkRoute('artist.edit', trans('htmusic.edit'), [$artist->id]) }})</div>
				<div class="panel-body">
					<div class="row">
						@if($artist->aliases()->count() > 0)
						<div class="col-md-2">{{ trans('htmusic.aliases') }}:</div>
						<div class="col-md-10">
							@foreach($artist->aliases() as $row)
								{{ $row->name }}
							@endforeach
						</div>
						@endif
						<div class="col-md-2">{{ trans('htmusic.type') }}:</div>
						<div class="col-md-10">{{ $artist->artistTypes()->first() }}</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Releases</div>
				<div class="panel-body">
{{--					@forelse ($artist->releases() as $row)--}}
						{{--<div class="row">--}}
							{{--<div class="col-md-4">{{ Html::linkRoute('release.show', $row->name, [$row->id])}}</div>--}}
						{{--</div>--}}
					{{--@empty--}}
						{{--<div class="row">{{ trans('htmusic.no_releases_found') }}</div>--}}
					{{--@endforelse--}}
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(function () {

		});
	</script>
@stop