@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.artist') }}</div>
				<div class="panel-body">
					{!! Form::open($form_route) !!}
					<div class="form-group @if ($errors->has('name')) has-error @endif ">
							{!! Form::label('name', trans('htmusic.name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('name', $artist->name, ['class' => 'form-control']) !!}
						</div>
						@if ($errors->has('name')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('name') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('sort_name')) has-error @endif ">
							{!! Form::label('sort_name', trans('htmusic.sort_name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('sort_name', $artist->sort_name, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('sort_name')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('sort_name') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('begin_date')) has-error @endif ">
							{!! Form::label('begin_date', trans('htmusic.begin_date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							<div class="input-group date" id="begin_date_group">
								{!! Form::text('begin_date', $artist->begin_date, ['class' => 'form-control', 'id' => 'begin_date']) !!}
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
								</div>
							</div>
						@if ($errors->has('begin_date')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('begin_date') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('is_ended')) has-error @endif ">
							{!! Form::label('is_ended', trans('htmusic.is_ended').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-1">
							{!! Form::checkbox('is_ended', ',', $artist->is_ended, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('is_ended')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('is_ended') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('end_date')) has-error @endif ">
							{!! Form::label('end_date', trans('htmusic.end_date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							<div class="input-group date" id="end_date_group">
							{!! Form::text('end_date', $artist->end_date, ['class' => 'form-control', 'id' => 'end_date']) !!}
							<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
								</div>
							</div>
						@if ($errors->has('end_date')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('end_date') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('type_id')) has-error @endif ">
							{!! Form::label('type_id', trans('htmusic.type').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('type_id', $artist_types, $artist->type_id, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('type_id')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('type_id') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('gender')) has-error @endif ">
							{!! Form::label('gender', trans('htmusic.gender').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('gender', ['other' => trans('htmusic.other'), 'male' => trans('htmusic.male'), 'female' => trans('htmusic.female')], $artist->gender, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('gender')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('gender') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('bio')) has-error @endif ">
							{!! Form::label('bio', trans('htmusic.bio').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::textarea('bio', $artist->bio, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('bio')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('bio') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('photo_url')) has-error @endif ">
							{!! Form::label('photo_url', trans('htmusic.photo_url').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('photo_url', $artist->photo_url, ['class' => 'form-control']) !!}
							</div>
							@if ($errors->has('photo_url')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('photo_url') }}</div> @endif
					</div>
					<div class="form-group">
							{!! Form::submit(trans('htmusic.submit'), ['class'=> 'btn btn-primary col-md-offset-2']) !!}
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>

{{--	{{ var_dump($infos) }}--}}

	<script type="text/javascript">
		$(function () {
			$(' #begin_date_group').datetimepicker({
				format: 'YYYY-MM-DD',
				maxDate: Date.now()
			});
			$('#end_date_group').datetimepicker({
				format: 'YYYY-MM-DD',
				useCurrent: false, //Important! See issue #1075
				maxDate: Date.now()
			});
			$("#begin_date_group").on("dp.change", function (e) {
				$('#end_date_group').data("DateTimePicker").minDate(e.date);
			});
			$("#end_date_group").on("dp.change", function (e) {
				$('#begin_date_group').data("DateTimePicker").maxDate(e.date);
			});
		});
	</script>
@stop