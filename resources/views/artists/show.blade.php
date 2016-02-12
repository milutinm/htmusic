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
					<h2>{{ $artist->name }}</h2>
					@can('admin')
						<div class="row">
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
												<th>{{ trans('htmusic.release') }}</th>
												<th>{{ trans('htmusic.year') }}</th>
											</tr>
										</thead>
										<tbody>
								@endif

								@foreach ($works as $row)
									@if ($w_type == 'tracks')
										<tr>
											<td>{{ Html::linkRoute('track.show', $row->name, [$row->id]) }}</td>
											<td>{{ $row->release->name }}</td>
											<td>@if($row->release->date != '0000-00-00'){{ substr($row->release->date,0,4) }}@else&nbsp;@endif</td>
										</tr>
									@else
										<div class="col-md-4">
											<a href="{{ route('release.show',['release' => $row->id]) }}">
												{{--									<pre>{{ print_r($row->image) }}</pre>--}}
												<div class="img-wrap">
													{{ Html::image(URL::route('image.display', $row->image), $row->name, ['class' => 'img-thumbnail img-responsive', 'width' => '100%']) }}
												</div>
												<div class="title">{{ $row->name }} @if($row->date != '0000-00-00')({{ substr($row->date,0,4) }})@endif</div>
												{{--<div class="credit">{{ $row->credit->name }}</div>--}}
											</a>
										</div>
									@endif
								@endforeach

								@if ($w_type == 'tracks')
										</tbody>
									</table>
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
							{{ Html::image(URL::route('image.display', $row->id), $artist->name, ['class' => 'img-thumbnail img-responsive']) }}
						</div>
					@empty
						<div class="">{{ trans('htmusic.no_images_found') }}</div>
					@endforelse
				</div>
			</div>

			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.links') }}</div>
				<div class="panel-body">
					@forelse ($artist->links as $row)
						<div>
							{{ Html::link( $row->url, $row->caption, ['target' => '_blank', 'title' => $row->description]) }} ({{ Html::linkRoute('link.show', trans('htmusic.view'), [$row->id])}})
						</div>
					@empty
						<div class="">{{ trans('htmusic.no_links_found') }}</div>
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