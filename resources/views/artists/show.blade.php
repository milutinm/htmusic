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

							{!! Form::open([
								'method' => 'GET',
								'route' => ['release.create'],
								'class'	=> 'navbar-form navbar-right',
							]) !!}
								{!! Form::hidden('artist_id',$artist->id) !!}
								{!! Form::submit(trans('htmusic.add_release'), ['class' => 'btn btn-primary']) !!}
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
								{{ Html::linkRoute('artistalias.show', $row->name, [$row->id]) }}
							@endforeach
						</div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.name') }}:</div>
						<div class="col-md-10">{{ $artist->name }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.sort_name') }}:</div>
						<div class="col-md-10">{{ $artist->sort_name }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.begin_date') }}:</div>
						<div class="col-md-10">{{ $artist->begin_date }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.is_ended') }}:</div>
						<div class="col-md-10">{{ $artist->is_ended }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.end_date') }}:</div>
						<div class="col-md-10">{{ $artist->end_date }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.type') }}:</div>
						<div class="col-md-10">{{ $artist->type->name }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.gender') }}:</div>
						<div class="col-md-10">{{ $artist->gender }}</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">Releases</div>
				<div class="panel-body">
					{{--{{ $artist->releases() }}--}}
					@forelse ($credits as $work => $credit_names)
						<div class="row">
							<h2>{{ $work }}</h2>
							@foreach ($credit_names as $w_type => $works)
								<h3>{{ $w_type }}</h3>
								@foreach ($works as $row)
								<div class="row">
									@if ($w_type == 'tracks')
										{{ Html::linkRoute('track.show', $row->name, [$row->id]) }} - {{ $row->release->name }} @if($row->release->date != '0000-00-00')({{ Carbon::createFromFormat('Y-m-d',$row->release->date)->format('Y') }})@endif

									@else
										{{ Html::linkRoute('release.show', $row->name, [$row->id]) }} @if($row->date != '0000-00-00')({{ Carbon::createFromFormat('Y-m-d',$row->date)->format('Y') }})@endif
									@endif
								</div>
								@endforeach
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