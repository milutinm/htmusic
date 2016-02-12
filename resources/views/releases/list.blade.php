@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2 class="col-md-4">{{ trans('htmusic.releases') }} ({{ $releases->total() }})</h2>
					@can('admin')
					{!! Form::open([
						'method' => 'GET',
						'route' => ['release.create'],
						'class'	=> 'navbar-form navbar-right',
					]) !!}
					{!! Form::submit(trans('htmusic.new'), ['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
					@endcan
				</div>
				<div class="panel-body">
					<div class="row">
					@forelse ($releases as $row)
						{{--<div class="row">--}}
							<div class="col-md-3 list-thumb">
								<a href="{{ route('release.show',['release' => $row->id]) }}">
{{--									<pre>{{ print_r($row->image) }}</pre>--}}
									<div class="img-wrap">
										{{ Html::image(URL::route('image.display', $row->image), $row->name, ['class' => 'img-thumbnail img-responsive', 'width' => '100%']) }}
									</div>
									<div class="title">{{ $row->name }}</div>
									<div class="info">{{ count($row->tracks) }} {{ trans('htmusic.tracks') }} @if($row->date != '0000-00-00')&middot; {{ substr($row->date,0,4) }}@endif</div>
									{{--<div class="credit">{{ $row->credit->name }}</div>--}}
								</a>
							</div>
						{{--</div>--}}
					@empty
						<div class="row">{{ trans('htmusic.no_releases_found') }}</div>
					@endforelse
					</div>
					<div class="row">
						{!! $releases->links() !!}
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