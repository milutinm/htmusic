@extends('layouts.app')

@section('content')
	<pre>
	{{--{{ var_dump($release) }}--}}
	{{--{{ var_dump($artist_credit) }}--}}
	</pre>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.track') }}</div>
				<div class="panel-body">
					{!! Form::open($form_route) !!}
					<div class="form-group">
							{!! Form::label('artist_credit_id', trans('htmusic.release').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('release_search', null, ['class' => 'form-control','id' => 'release_search']) !!}
							</div>
					</div>
					<div class="form-group">
						<div id="release_search_list" class="row"></div>
						<div id="release_selected" class="col-md-offset-2 col-md-10 form-inline">
							@if (isset($release))
							<div class="row">
								<input type="hidden" value="{{ $release->id }}" name="release_id" />
								<label style="margin-left: 30px;"><a href="/release/{{ $release->id }}" target="_blank">{{ $release->name }}</a></label>
								<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							</div>
							@endif
						</div>
					</div>

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
			$('#release_search_list').btsListFilter('#release_search', {
				sourceTmpl: '<a class="list-group-item release_search_item" href="{id}"><strong>{name}</strong> - <i>{artist}</i></a>',
				sourceData: function(text, callback) {
					return $.getJSON('/release/search/'+text, function(json) {
						callback(json);
					});
				}
			});

			$('#release_search_list').on('click','a',function(e){
				e.preventDefault();

				$.ajax({
					'url'	: '/release/'+$(this).attr('href')
				}).done(function(data){
					console.log(data);

					var work_types = '';

					for(i in data.work_type) {
						work_types	+= '<option value="'+data.work_type[i].id+'">'+data.work_type[i].name+'</option>'
					}

					$('#release_selected').html(
							'<div class="row">' +
							'<input type="hidden" value="'+data.release.id+'" name="release_id" />' +
							'<label style="margin-left: 30px;"><a href="/release/'+data.release.id+'" target="_blank">'+data.release.name +'</a></label>' +
							'<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
							'</div>'
					);

					// ----------------------
					var work_types = '';

					for (j in data.credit.credit_name) {

						for (i in data.work_type) {
							work_types += '<option value="' + data.work_type[i].id + '"'+(data.work_type[i].id == data.credit.credit_name[j].work_type_id ? 'selected="selected"':'')+'>' + data.work_type[i].name + '</option>'
						}

						$('#credit_selected').append(
								'<div class="row">' +
								'<select name="artist_credit[work][]" class="form-control" >' +
								work_types +
								'</select>' +
								'<input type="hidden" value="' + data.credit.credit_name[j].artist_id + '" name="artist_credit[id][]" />' +
								'<label style="margin-left: 30px;"><a href="/artist/'+data.credit.credit_name[j].artist_id+'" target="_blank">' + data.credit.credit_name[j].name + '</a></label>' +
								'<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
								'</div>'
						);
					}
					// --------------------
				});
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

			$('#credit_selected, #release_selected').on('click','button.close',function(e){
				$(this).parent().remove();
			});

		});
	</script>
@stop