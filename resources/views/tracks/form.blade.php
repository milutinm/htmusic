@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.track') }}</div>
				<div class="panel-body">
					{!! Form::open($form_route) !!}
					<div class="form-group @if ($errors->has('name')) has-error @endif ">
							{!! Form::label('name', trans('htmusic.name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('name', $track->name, ['class' => 'form-control']) !!}
						</div>
						@if ($errors->has('name')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('name') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('number')) has-error @endif ">
							{!! Form::label('number', trans('htmusic.number').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('number', $track->number, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('number')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('number') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('position')) has-error @endif ">
							{!! Form::label('position', trans('htmusic.position').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('position', $track->position, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('position')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('position') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('artist_credit_id')) has-error @endif ">
							{!! Form::label('artist_credit_id', trans('htmusic.credit').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('artist_credit_id', $artist_credit, $track->artist_credit_id, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('artist_credit_id')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('artist_credit_id') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('length')) has-error @endif ">
							{!! Form::label('length', trans('htmusic.length').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('length', $track->length, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('length')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('length') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('notes')) has-error @endif ">
							{!! Form::label('notes', trans('htmusic.notes').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::textarea('notes', $track->notes, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('notes')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('notes') }}</div> @endif
					</div>

					<div class="form-group">
							{!! Form::submit(trans('htmusic.submit'), ['class'=> 'btn btn-primary col-md-offset-2']) !!}
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(function () {

		});
	</script>
@stop