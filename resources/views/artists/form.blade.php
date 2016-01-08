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
							{!! Form::text('name', $artist->name, ['class' => 'form-control']) !!}
						</div>
					</div>
					<div class="form-group">
							{!! Form::label('sort_name', trans('htmusic.sort_name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('sort_name', $artist->sort_name, ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('begin_date', trans('htmusic.begin_date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							<div class="input-group date" id="begin_date_group">
								{!! Form::text('begin_date', $artist->begin_date, ['class' => 'form-control', 'id' => 'begin_date']) !!}
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
								</div>
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('is_ended', trans('htmusic.is_ended').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-1">
							{!! Form::checkbox('is_ended', ',', $artist->is_ended, ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('end_date', trans('htmusic.end_date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							<div class="input-group date" id="end_date_group">
							{!! Form::text('end_date', $artist->end_date, ['class' => 'form-control', 'id' => 'end_date']) !!}
							<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
								</div>
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('type_id', trans('htmusic.type').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('type_id', $artist_types, $artist->type_id, ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('gender', trans('htmusic.gender').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('gender', ['other' => trans('htmusic.other'), 'male' => trans('htmusic.male'), 'female' => trans('htmusic.female')], $artist->gender, ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('bio', trans('htmusic.bio').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::textarea('bio', $artist->bio, ['class' => 'form-control']) !!}
							</div>
					</div>
					<div class="form-group">
							{!! Form::label('photo_url', trans('htmusic.photo_url').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('photo_url', $artist->photo_url, ['class' => 'form-control']) !!}
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

	<script type="text/javascript">
		$(function () {
			$(' #begin_date_group').datetimepicker({
				format: 'YYYY-MM-DD'
			});
			$('#end_date_group').datetimepicker({
				format: 'YYYY-MM-DD',
				useCurrent: false //Important! See issue #1075
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