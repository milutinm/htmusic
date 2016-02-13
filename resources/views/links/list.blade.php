@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2>{{ trans('htmusic.links') }} ({{ $links->total() }})
					@can('admin')
						{{ Html::linkRoute('link.create', trans('htmusic.new'), [], ['class' => 'btn btn-default glyphicons-edit pull-right']) }}
					@endcan
					</h2>
				</div>
				<div class="panel-body">
					<div class="row">
					@forelse ($links as $row)
						<div class="col-md-4">{{ Html::linkRoute('link.show', $row->caption, [$row->id])}}</div>
					@empty
						<div class="row">{{ trans('htmusic.no_links_found') }}</div>
					@endforelse
					</div>
					<div class="row">
						{!! $links->links() !!}
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