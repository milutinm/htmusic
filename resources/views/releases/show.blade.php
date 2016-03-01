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
					<h2>{{ $release->name }}
					@can('admin')
						<div class="dropdown  pull-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-wrench"></span>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
								<li>{{ Html::linkRoute('release.edit', trans('htmusic.edit'), ['release' => $release->id]) }}</li>
								<li>{{ Html::linkRoute('release.destroy', trans('htmusic.delete'), ['release' => $release->id], ['data-confirm' => trans('htmusic.are_you_sure'), 'data-token' => csrf_token(),'data-method' => 'DELETE']) }}</li>
								<li role="separator" class="divider"></li>
								<li>{{ Html::linkRoute('link.create', trans('htmusic.add_link'), ['release_id' => $release->id]) }}</li>
								<li>{{ Html::linkRoute('image.create', trans('htmusic.add_image'), ['release_id' => $release->id]) }}</li>
								<li>{{ Html::linkRoute('track.create', trans('htmusic.add_track'), ['release_id' => $release->id]) }}</li>
							</ul>
						</div>
					@endcan
					</h2>
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
				<div class="panel-heading">{{ trans('htmusic.tracks') }}</div>
				<div class="panel-body">
					<table class="table table-striped">
						<thead>
						<tr>
							<th>{{ trans('htmusic.title') }}</th>
							<th>&nbsp;</th>
							{{--<th>{{ trans('htmusic.length') }}</th>--}}
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
				<div class="list-group">
					@forelse ($release->credit->credit_name as $row)
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



			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.images') }}</div>
				<div class="panel-body">
					@forelse ($release->images as $row)
						<div class="col-md-6">
							<a href="{{ URL::route('image.show', $row->id) }}">
							{{ Html::image(URL::route('image.display', $row->id), $row->caption, ['class' => 'img-thumbnail img-responsive']) }}
								<div>{{ $row->caption }}</div>
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
					@forelse ($release->links as $row)
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