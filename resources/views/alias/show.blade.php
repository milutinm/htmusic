@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $alias->name }}</h1>
            <p>{{ $alias->bio }}</p>
        </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2 class="col-md-8">{{ $alias->name }} ({{ Html::linkRoute('artist.show', $alias->artist->name, [$alias->artist->id]) }})</h2>
					@can('admin')
						<div class="col-md-4">
							{!! Form::open([
								'method' => 'DELETE',
								'route' => ['artistalias.destroy', $alias->id],
								'class'	=> 'navbar-form navbar-right prompt-confirm',
								'msg'	=> trans('htmusic.are_you_sure')
							]) !!}
								{!! Form::submit(trans('htmusic.delete'), ['class' => 'btn btn-danger']) !!}
							{!! Form::close() !!}

							{!! Form::open([
								'method' => 'GET',
								'route' => ['artistalias.edit', $alias->id],
								'class'	=> 'navbar-form navbar-right',
							]) !!}
								{!! Form::submit(trans('htmusic.edit'), ['class' => 'btn btn-primary']) !!}
							{!! Form::close() !!}

						</div>
					@endcan
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.name') }}:</div>
						<div class="col-md-10">{{ $alias->name }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.sort_name') }}:</div>
						<div class="col-md-10">{{ $alias->sort_name }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.begin_date') }}:</div>
						<div class="col-md-10">{{ $alias->begin_date }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.is_ended') }}:</div>
						<div class="col-md-10">{{ $alias->is_ended }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.end_date') }}:</div>
						<div class="col-md-10">{{ $alias->end_date }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.type') }}:</div>
						<div class="col-md-10">{{ $alias->type->name }}</div>
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