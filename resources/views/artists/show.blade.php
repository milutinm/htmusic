@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $artist->name }}</h1>
            <p>{{ $artist->bio }}</p>
        </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2 class="col-md-8">{{ $artist->name }}</h2>
					@can('admin')
						<div class="col-md-4">
							{!! Form::open([
								'method' => 'DELETE',
								'route' => ['artist.destroy', $artist->id],
								'class'	=> 'navbar-form navbar-right prompt-confirm',
								'msg'	=> trans('htmusic.are_you_sure')
							]) !!}
								{!! Form::submit(trans('htmusic.delete'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}

							{!! Form::open([
								'method' => 'GET',
								'route' => ['artist.edit', $artist->id],
								'class'	=> 'navbar-form navbar-right',
							]) !!}
								{!! Form::submit(trans('htmusic.edit'), ['class' => 'btn btn-primary']) !!}
							{!! Form::close() !!}
						</div>
					@endcan
				</div>
				<div class="panel-body">
					<div class="row">
						@if($artist->aliases()->count() > 0)
						<div class="col-md-2">{{ trans('htmusic.aliases') }}:</div>
						<div class="col-md-10">
							@foreach($artist->aliases as $row)
								{{ $row->name }}
							@endforeach
						</div>
						@endif
						<div class="col-md-2">{{ trans('htmusic.type') }}:</div>
						<div class="col-md-10">{{ $artist->type->name }}</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Releases</div>
				<div class="panel-body">
					{{--{{ $artist->releases() }}--}}
					@forelse ($artist->releases as $row)
						<div class="row">
							<h2>releases</h2>
							@foreach ($row->credit->releases as $release)
							<div class="row">
								<h3>{{ Html::linkRoute('release.show', $release->name, [$release->id]) }} ({{ Carbon::createFromFormat('Y-m-d',$release->date)->format('Y') }})</h3>
								@foreach ($release->tracks as $track)
								<div class="row">
									{{ Html::linkRoute('track.show', $track->name, [$track->id]) }}
								</div>
								@endforeach
							</div>
							@endforeach
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_releases_found') }}</div>
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