@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.release') }}</div>
				<div class="panel-body">
					{!! Form::open($form_route) !!}
					<div class="form-group">
						{!! Form::label('credit_search', trans('htmusic.credit').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('credit_search', '', ['class' => 'form-control','id' => 'credit_search']) !!}
						</div>
					</div>
					<div class="form-group">
						<div id="credit_search_list" class="row"></div>
						<div id="credit_selected" class="col-md-offset-2 col-md-10 form-inline">
							@if (isset($artist_credit))
								@foreach($artist_credit as $row)
								<div class="row">
									<select name="artist_credit[work][]" class="form-control" >
									@foreach($work_type as $wt_row)
										<option value="{{ $wt_row->id }}" @if($wt_row->id == $row->work_type_id) selected="selected" @endif>{{ $wt_row->name }}</option>
									@endforeach
									</select>
									<input type="hidden" value="{{ $row->artist_id }}" name="artist_credit[id][]" />
									<label style="margin-left: 30px;"><a href="/artist/{{ $row->artist_id }}" target="_blank">{{ $row->name }}</a></label>
									<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								@endforeach
							@endif
						</div>
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
					<div class="form-group @if ($errors->has('release_type_id')) has-error @endif ">
							{!! Form::label('type_id', trans('htmusic.type').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::select('release_type_id', $release_type, $release->release_type_id, ['class' => 'form-control']) !!}
							</div>
						@if ($errors->has('release_type_id')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('release_type_id') }}</div> @endif
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
							{!! Form::text('barcode', $release->barcode, ['class' => 'form-control']) !!}
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

					var work_types = '';

					for(i in data.work_type) {
						work_types	+= '<option value="'+data.work_type[i].id+'">'+data.work_type[i].name+'</option>'
					}

					$('#credit_selected').append(
							'<div class="row">' +
							'<select name="artist_credit[work][]" class="form-control" >' +
							work_types+
							'</select>' +
							'<input type="hidden" value="'+data.artist.id+'" name="artist_credit[id][]" />' +
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