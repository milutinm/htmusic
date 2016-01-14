@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.release') }}</div>
				<div class="panel-body">
					{!! Form::open($form_route) !!}
					<div class="form-group @if ($errors->has('artist_credit_id')) has-error @endif ">
						{{-- <!-- TODO select credits --> --}}
						{!! Form::label('artist_credit_id', trans('htmusic.artist').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('artist_credit_id', $artist_credit, $release->artist_credit_id, ['class' => 'form-control']) !!}
						</div>
						@if ($errors->has('artist_credit_id')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('artist_credit_id') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('medium_id')) has-error @endif ">
						{!! Form::label('medium_id', trans('htmusic.medium').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('medium_id', $medium_types, $release->medium_id, ['class' => 'form-control']) !!}
						</div>
						@if ($errors->has('medium_id')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('medium_id') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('release_status_id')) has-error @endif ">
							{!! Form::label('type_id', trans('htmusic.status').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('release_status_id', $release_status, $release->release_status_id, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('release_status_id')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('release_status_id') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('name')) has-error @endif ">
							{!! Form::label('name', trans('htmusic.name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('name', $release->name, ['class' => 'form-control']) !!}
						</div>
						@if ($errors->has('name')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('name') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('barcode')) has-error @endif ">
							{!! Form::label('barcode', trans('htmusic.barcode').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('name', $release->barcode, ['class' => 'form-control']) !!}
						</div>
						@if ($errors->has('barcode')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('barcode') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('date')) has-error @endif ">
							{!! Form::label('date', trans('htmusic.date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							<div class="input-group date" id="date_group">
							{!! Form::text('date', $release->date, ['class' => 'form-control', 'id' => 'date']) !!}
							<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
								</div>
							</div>
						@if ($errors->has('date')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('date') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('notes')) has-error @endif ">
							{!! Form::label('bio', trans('htmusic.notes').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::textarea('notes', $release->notes, ['class' => 'form-control']) !!}
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

{{--	{{ var_dump($infos) }}--}}

	<script type="text/javascript">
		$(function () {
			$(' #date_group').datetimepicker({
				format: 'YYYY-MM-DD',
				maxDate: Date.now()
			});
		});
	</script>
@stop