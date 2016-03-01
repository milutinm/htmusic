@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
			<div class="col-md-2">
				{{ Html::image(URL::route('image.display', $artist->image), $artist->name, ['class' => 'img-thumbnail img-responsive']) }}
			</div>
			<div class="col-md-10">
				<h1>{{ $artist->name }}</h1>
				<p>{{ $artist->bio }}</p>
			</div>
        </div>
    </div>
	<div class="container">
		<div class="col-md-8">

			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2>{{ $artist->name }}
					@can('admin')
						<div class="dropdown  pull-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-wrench"></span>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
								<li>{{ Html::linkRoute('artist.edit', trans('htmusic.edit'), ['artist' => $artist->id]) }}</li>
								<li>{{ Html::linkRoute('artist.destroy', trans('htmusic.delete'), ['artist' => $artist->id], ['data-confirm' => trans('htmusic.are_you_sure'), 'data-token' => csrf_token(),'data-method' => 'DELETE']) }}</li>
								<li role="separator" class="divider"></li>
								<li>{{ Html::linkRoute('link.create', trans('htmusic.add_link'), ['artist_id' => $artist->id]) }}</li>
								<li>{{ Html::linkRoute('image.create', trans('htmusic.add_image'), ['artist_id' => $artist->id]) }}</li>
								<li>{{ Html::linkRoute('artistalias.create', trans('htmusic.add_alias'), ['artist_id' => $artist->id]) }}</li>
								<li>{{ Html::linkRoute('release.create', trans('htmusic.add_release'), ['artist_id' => $artist->id]) }}</li>
							</ul>
						</div>
					@endcan
					</h2>
				</div>
				<div class="panel-body">
					<div class="row">
						@if($artist->aliases()->count() > 0)
						<div class="col-md-2">{{ trans('htmusic.aliases') }}:</div>
						<div class="col-md-10">
							@foreach($artist->aliases as $row)
								{{ Html::linkRoute('artistalias.show', $row->name, [$row->id]) }} @if ($row != $artist->aliases->last()),@endif
							@endforeach
						</div>
						@endif
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.name') }}:</div>
						<div class="col-md-10">{{ $artist->name }}</div>
					</div>
					@can('admin')
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.sort_name') }}:</div>
						<div class="col-md-10">{{ $artist->sort_name }}</div>
					</div>
					@endcan
					@if ($artist->begin_date != '0000-00-00')
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.begin_date') }}:</div>
						<div class="col-md-10">{{ $artist->begin_date }}</div>
					</div>
					@endif
					@if ($artist->is_ended)
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.is_ended') }}:</div>
						<div class="col-md-10">{{ $artist->is_ended }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.end_date') }}:</div>
						<div class="col-md-10">{{ $artist->end_date }}</div>
					</div>
					@endif
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
				<div class="panel-heading">{{ trans('htmusic.credit') }}</div>
				<div class="panel-body">
					{{--{{ $artist->releases() }}--}}
					@forelse ($credits as $work => $credit_names)
						<div class="">
							@if ($work != 'N/A')
							<h2>{{ $work }}</h2>
							@endif

							@foreach ($credit_names as $w_type => $works)
								<div class="row">
								<h3>{{ $w_type }}</h3>
								@if ($w_type == 'tracks')
									<table class="table table-striped">
										<thead>
											<tr>
												<th>{{ trans('htmusic.title') }}</th>
												<th>&nbsp;</th>
												<th>{{ trans('htmusic.release') }}</th>
												<th>{{ trans('htmusic.year') }}</th>
											</tr>
										</thead>
										<tbody>
								@else
									<div>
								@endif

								@foreach ($works as $row)
									@if ($w_type == 'tracks')
										<tr>
											<td>{{ Html::linkRoute('track.show', $row->name, [$row->id]) }}</td>
											<td>@if ($row->length > -0){{ gmdate('i:s', $row->length) }}@else&nbsp;@endif</td>
											<td>{{ $row->release->name }}</td>
											<td>@if($row->release->date != '0000-00-00'){{ substr($row->release->date,0,4) }}@else&nbsp;@endif</td>
										</tr>
									@else
										<div class="col-md-4 list-thumb">
											<a href="{{ route('release.show',['release' => $row->id]) }}">
												{{--									<pre>{{ print_r($row->image) }}</pre>--}}
												<div class="img-wrap">
													{{ Html::image(URL::route('image.display', $row->image), $row->name, ['class' => 'img-thumbnail img-responsive', 'width' => '100%']) }}
												</div>
												<div class="title">{{ $row->name }} @if($row->date != '0000-00-00')({{ substr($row->date,0,4) }})@endif</div>
												<div class="info">{{ count($row->tracks) }} {{ trans('htmusic.tracks') }} @if($row->date != '0000-00-00')&middot; {{ substr($row->date,0,4) }}@endif</div>
												{{--<div class="credit">{{ $row->credit->name }}</div>--}}
											</a>
										</div>
									@endif
								@endforeach

								@if ($w_type == 'tracks')
										</tbody>
									</table>
								@else
									</div>
								@endif
								</div>
							@endforeach
						</div>
					@empty
						<div class="">{{ trans('htmusic.no_credits_found') }}</div>
					@endforelse
				</div>
			</div>

		</div>

		<div class="col-md-4">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.images') }}</div>
				<div class="panel-body">
					@forelse ($artist->images as $row)
						<div class="col-md-6">
							<a href="{{ URL::route('image.show', $row->id) }}">
							{{ Html::image(URL::route('image.display', $row->id), $row->caption, ['class' => 'img-thumbnail img-responsive']) }}
								<div>{{ $row->caption }}</div>
							</a>
						</div>
					@empty
						<div class="">{{ trans('htmusic.no_images_found') }}</div>
					@endforelse
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.links') }}</div>

				<div class="list-group">
					@forelse ($artist->links as $row)
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