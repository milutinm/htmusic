@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.artist') }}</div>
				<div class="panel-body">
					{!! Form::open($form_route) !!}
					<div class="form-group">
							{!! Form::label('name', trans('htmusic.name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('name', '', ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
							{!! Form::label('sort_name', trans('htmusic.sort_name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('sort_name', '', ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('begin_date', trans('htmusic.begin_date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('begin_date', '', ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('is_ended', trans('htmusic.is_ended').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('is_ended', '', ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('end_date', trans('htmusic.end_date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('end_date', '', ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('type_id', trans('htmusic.type').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('type_id', '', ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('gender', trans('htmusic.gender').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('gender', '', ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('bio', trans('htmusic.bio').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::textarea('bio', '', ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('photo_url', trans('htmusic.photo_url').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('photo_url', '', ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::submit(trans('htmusic.submit'), ['class'=> 'btn btn-primary col-md-offset-2']) !!}
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@stop