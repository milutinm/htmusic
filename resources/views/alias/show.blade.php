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
					<h2>{{ $alias->name }} ({{ Html::linkRoute('artist.show', $alias->artist->name, [$alias->artist->id]) }})
					@can('admin')
						<div class="dropdown  pull-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-wrench"></span>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
								<li>{{ Html::linkRoute('artistalias.edit', trans('htmusic.edit'), ['artistalias' => $alias->id]) }}</li>
								<li>{{ Html::linkRoute('artistalias.destroy', trans('htmusic.delete'), ['artistalias' => $alias->id], ['data-confirm' => trans('htmusic.are_you_sure'), 'data-token' => csrf_token(),'data-method' => 'DELETE']) }}</li>
							</ul>
						</div>
					@endcan
					</h2>
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