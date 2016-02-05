@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2 class="col-md-6">{{ trans('htmusic.links') }} ({{ $links->total() }})</h2>
					@can('admin')
					{!! Form::open([
						'method' => 'GET',
						'route' => ['link.create'],
						'class'	=> 'navbar-form navbar-right',
					]) !!}
					{!! Form::submit(trans('htmusic.new'), ['class' => 'btn btn-primary']) !!}
					{!! Form::close() !!}
					@endcan
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