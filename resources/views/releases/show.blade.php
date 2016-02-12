@extends('layouts.app')

@section('content')
	 <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
			<div class="col-md-2">
				{{ Html::image(URL::route('image.display', $release->image), $release->name, ['class' => 'img-thumbnail img-responsive']) }}
			</div>
			<div class="col-md-10">
            	<h1>{{ $release->name }} @if($release->date != '0000-00-00')({{ substr($release->date,0,4) }})@endif</h1>
			</div>
        </div>
    </div>
	<div class="container">
		<div class="col-md-8">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2>{{ $release->name }}</h2>
					@can('admin')
					<div class="row">
						{!! Form::open([
							'method' => 'DELETE',
							'route' => ['release.destroy', $release->id],
							'class'	=> 'navbar-form navbar-right prompt-confirm',
							'msg'	=> trans('htmusic.are_you_sure')
						]) !!}
							{!! Form::submit(trans('htmusic.delete'), ['class' => 'btn btn-danger']) !!}
						{!! Form::close() !!}

						{!! Form::open([
							'method' => 'GET',
							'route' => ['release.edit', $release->id],
							'class'	=> 'navbar-form navbar-right'
						]) !!}
							{!! Form::submit(trans('htmusic.edit'), ['class' => 'btn btn-primary']) !!}
						{!! Form::close() !!}

						{!! Form::open([
								'method' => 'GET',
								'route' => ['track.create'],
								'class'	=> 'navbar-form navbar-right',
							]) !!}
								{!! Form::hidden('release_id',$release->id) !!}
								{!! Form::submit(trans('htmusic.add_track'), ['class' => 'btn btn-primary']) !!}
							{!! Form::close() !!}
					</div>
					@endcan
				</div>
				<div class="panel-body">
					{{--<div class="row">--}}
						{{--<div class="col-md-2">{{ trans('htmusic.name') }}:</div>--}}
						{{--<div class="col-md-10">{{ $release->name }}</div>--}}
					{{--</div>--}}
					@if(isset($release->note))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.note') }}:</div>
						<div class="col-md-10">{{ $release->note }}</div>
					</div>
					@endif
					@if(isset($release->barcode) && $release->barcode != '')
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.barcode') }}:</div>
						<div class="col-md-10">{{ $release->barcode }}</div>
					</div>
					@endif
					@if(isset($release->type->name))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.type') }}:</div>
						<div class="col-md-10">{{ $release->type->name }}</div>
					</div>
					@endif
					@if(isset($release->status->name))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.status') }}:</div>
						<div class="col-md-10">{{ $release->status->name }}</div>
					</div>
					@endif
					@if(isset($release->medium->name))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.medium') }}:</div>
						<div class="col-md-10">{{ $release->medium->name }}</div>
					</div>
					@endif

					@if(count($release->genres))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.genre') }}:</div>
						<div class="col-md-10">
							@foreach($release->genres as $n => $row)
							{{ $row->name }}@if(isset($release->genres[$n + 1])),@endif
							@endforeach
						</div>
					</div>
					@endif

					@if(count($release->labels))
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.label') }}:</div>
						<div class="col-md-10">
							@foreach($release->labels as $n => $row)
							{{ Html::linkRoute('label.show', $row->name, [$row->id]) }}@if(isset($release->labels[$n + 1])),@endif
							@endforeach
						</div>
					</div>
					@endif
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
							{{ $row->join_phrase }} {{ Html::linkRoute('artist.show', $row->artist->name, [$row->artist->id]) }} ({{ $row->work->name }})
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_credits_found') }}</div>
					@endforelse

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.tracks') }}</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
						<tr>
							<th>{{ trans('htmusic.title') }}</th>
							<th>{{ trans('htmusic.length') }}</th>
						</tr>
						</thead>
						<tbody>
					@forelse ($release->tracks as $row)
						<tr>
							<td>{{ Html::linkRoute('track.show', $row->name, [$row->id]) }}</td>
							<td>@if ($row->length > -0){{ gmdate('i:s', $row->length) }}@else&nbsp;@endif</td>
						</tr>
					@empty
						<tr>
							<td colspan="2">{{ trans('htmusic.no_tracks_found') }}</td>
						</tr>
					@endforelse

						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.credits') }}</div>
				<div class="panel-body">
					{{ $release->credit->name }}
					{{--					{{ $release->credit->credit_name }}--}}
					@forelse ($release->credit->credit_name as $row)
						<div class="row">
							{{--{{ $row->name }}<br>--}}
							{{ $row->join_phrase }} {{ Html::linkRoute('artist.show', $row->artist->name, [$row->artist->id]) }} ({{ $row->work->name }})
						</div>
					@empty
						<div class="row">{{ trans('htmusic.no_credits_found') }}</div>
					@endforelse

				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.images') }}</div>
				<div class="panel-body">
					@forelse ($release->images as $row)
						<div class="col-md-6">
							{{ Html::image(URL::route('image.display', $row->id), $release->name, ['class' => 'img-thumbnail img-responsive']) }}
						</div>
					@empty
						<div>{{ trans('htmusic.no_images_found') }}</div>
					@endforelse
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.links') }}</div>
				<div class="panel-body">
					@forelse ($release->links as $row)
						<div>
							{{ Html::link( $row->url, $row->caption, ['target' => '_blank', 'title' => $row->description]) }} ({{ Html::linkRoute('link.show', trans('htmusic.view'), [$row->id])}})
						</div>
					@empty
						<div>{{ trans('htmusic.no_links_found') }}</div>
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