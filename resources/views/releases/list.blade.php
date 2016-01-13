@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.releases') }} ({{ $releases->total() }})</div>
				<div class="panel-body">
					<div class="row">
					@forelse ($releases as $row)
						{{--<div class="row">--}}
							<div class="col-md-4">{{ Html::linkRoute('artist.show', $row->name, [$row->id])}}</div>
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