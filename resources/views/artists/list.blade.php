@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2 class="col-md-4">{{ trans('htmusic.artists') }} ({{ $artists->total() }})</h2>
					@can('admin')
						{!! Form::open([
							'method' => 'GET',
							'route' => ['artist.create'],
							'class'	=> 'navbar-form navbar-right',
						]) !!}
							{!! Form::submit(trans('htmusic.new'), ['class' => 'btn btn-primary']) !!}
						{!! Form::close() !!}
					@endcan
				</div>
				<div class="panel-body">
					<div class="row">
					@forelse ($artists as $row)
						{{--<div class="row">--}}
							<div class="col-md-3 list-thumb">
								<a href="{{ route('artist.show',['release' => $row->id]) }}">
									<div class="img-wrap">
										{{ Html::image(URL::route('image.display', $row->image), $row->name, ['class' => 'img-thumbnail img-responsive', 'width' => '100%']) }}
									</div>
									<div class="title">{{ $row->name }}</div>
									{{--<div class="credit">{{ $row->credit->name }}</div>--}}
								</a>
							</div>
						{{--</div>--}}
					@empty
						<div class="row">{{ trans('htmusic.no_artists_found') }}</div>
					@endforelse
					</div>
					<div class="row">
						{!! $artists->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(function () {

		});
	</script>
@stop