@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.artists') }} ({{ $artists->total() }})</div>
				<div class="panel-body">
					<div class="row">
					@forelse ($artists as $row)
						{{--<div class="row">--}}
							<div class="col-md-4">{{ Html::linkRoute('artist.show', $row->name, [$row->id])}}</div>
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