@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.alias') }}</div>
				<div class="panel-body">
					{!! Form::open($form_route) !!}
					<div class="form-group">
						{!! Form::label('credit_search', trans('htmusic.artist').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('credit_search', '', ['class' => 'form-control','id' => 'credit_search']) !!}
						</div>
					</div>
					<div class="form-group">
						<div id="credit_search_list" class="row"></div>
						<div id="credit_selected" class="col-md-offset-2 col-md-10 form-inline">
							@if (isset($alias->artist_id))
								<div class="row">
									<input type="hidden" value="{{ $alias->artist_id }}" name="artist_id" />
									<label style="margin-left: 30px;"><a href="/artist/{{ $alias->artist_id }}" target="_blank">{{ $alias->artist_name }}</a></label>
									<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
							@endif
						</div>
					</div>
					<div class="form-group @if ($errors->has('name')) has-error @endif ">
							{!! Form::label('name', trans('htmusic.name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('name', $alias->name, ['class' => 'form-control']) !!}
						</div>
						@if ($errors->has('name')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('name') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('sort_name')) has-error @endif ">
							{!! Form::label('sort_name', trans('htmusic.sort_name').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('sort_name', $alias->sort_name, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('sort_name')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('sort_name') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('begin_date')) has-error @endif ">
							{!! Form::label('begin_date', trans('htmusic.begin_date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							<div class="input-group date" id="begin_date_group">
								{!! Form::text('begin_date', $alias->begin_date, ['class' => 'form-control', 'id' => 'begin_date']) !!}
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
							{!! Form::checkbox('is_ended', ',', $alias->is_ended, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('is_ended')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('is_ended') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('end_date')) has-error @endif ">
							{!! Form::label('end_date', trans('htmusic.end_date').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							<div class="input-group date" id="end_date_group">
							{!! Form::text('end_date', $alias->end_date, ['class' => 'form-control', 'id' => 'end_date']) !!}
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
							{!! Form::select('artist_alias_type_id', $alias_types, $alias->type_id, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('type_id')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('type_id') }}</div> @endif
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

			$('#credit_search_list').btsListFilter('#credit_search', {
				sourceTmpl: '<a class="list-group-item artist_search_item" href="{id}"><strong>{name}</strong> type:{type} gender:{gender}</a>',
				sourceData: function(text, callback) {
					return $.getJSON('/artist/search/'+text, function(json) {
						callback(json);
					});
				}
			});

			$('#credit_search_list').on('click','a',function(e){
				e.preventDefault();

				$.ajax({
					'url'	: '/artist/'+$(this).attr('href')
				}).done(function(data){
					console.log(data);

					$('#credit_selected').html(
							'<div class="row">' +
							'<input type="hidden" value="'+data.artist.id+'" name="artist_id" />' +
							'<label style="margin-left: 30px;"><a href="/artist/'+data.artist.id+'" target="_blank">'+data.artist.name +'</a></label>' +
							'<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
							'</div>'
					);
				});
			});

			$('#credit_selected').on('click','button.close',function(e){
				$(this).parent().remove();
			});
		});
	</script>
@stop