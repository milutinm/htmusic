@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading">{{ trans('htmusic.link') }}</div>
				<div class="panel-body">
					{!! Form::open($form_route) !!}

					<div class="form-group">
						{!! Form::label('artist_search', trans('htmusic.artist').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('artist_search', '', ['class' => 'form-control','id' => 'artist_search']) !!}
						</div>
					</div>
					<div class="form-group">
						<div id="artist_search_list" class="row"></div>
						<div id="artist_selected" class="col-md-offset-2 col-md-10 form-inline">
							@if($link->artists->count() > 0)
								@foreach($link->artists as $row)
								<div class="row">
									<input type="hidden" value="{{ $row->id }}" name="artist_id[]" />
									<a href="/artist/{{ $row->id }}" target="_blank">{{ $row->name }}</a>
									<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								@endforeach
							@endif
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('release_search', trans('htmusic.release').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('release_search', null, ['class' => 'form-control','id' => 'release_search']) !!}
						</div>
					</div>
					<div class="form-group">
						<div id="release_search_list" class="row"></div>
						<div id="release_selected" class="col-md-offset-2 col-md-10 form-inline">
							@if($link->releases->count() > 0)
								@foreach($link->releases as $row)
								<div class="row">
									<input type="hidden" value="{{ $row->id }}" name="release_id[]" />
									<a href="/release/{{ $row->id }}" target="_blank">{{ $row->name }}</a>
									<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								@endforeach
							@endif
						</div>
					</div>

					<div class="form-group">
						{!! Form::label('track_search', trans('htmusic.track').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('track_search', '', ['class' => 'form-control','id' => 'track_search']) !!}
						</div>
					</div>
					<div class="form-group">
						<div id="track_search_list" class="row"></div>
						<div id="track_selected" class="col-md-offset-2 col-md-10 form-inline">
							@if($link->tracks->count() > 0)
								@foreach($link->tracks as $row)
									<div class="row">
										<input type="hidden" value="{{ $row->id }}" name="track_id[]" />
										<a href="/track/{{ $row->id }}" target="_blank">{{ $row->name }}</a>
										<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									</div>
								@endforeach
							@endif
						</div>
					</div>


					<div class="form-group @if ($errors->has('url')) has-error @endif ">
						{!! Form::label('url', trans('htmusic.url').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::url('url', $link->url, ['class' => 'form-control', 'required' => 'required']) !!}
						</div>
						@if ($errors->has('url')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('url') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('caption')) has-error @endif ">
						{!! Form::label('caption', trans('htmusic.caption').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::text('caption', $link->caption, ['class' => 'form-control', 'required' => 'required']) !!}
						</div>
						@if ($errors->has('caption')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('caption') }}</div> @endif
					</div>
					<div class="form-group @if ($errors->has('description')) has-error @endif ">
						{!! Form::label('description', trans('htmusic.description').':', ['class' => 'col-md-2 control-label']) !!}
						<div class="col-md-10">
							{!! Form::textarea('description', $link->description, ['class' => 'form-control']) !!}
						</div>
						@if ($errors->has('description')) <div class="col-md-offset-2 col-md-10 help-block">{{ $errors->first('description') }}</div> @endif
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

				$('#release_selected').append(
						'<div class="row">' +
						'<input type="hidden" value="'+$(this).attr('href')+'" name="release_id[]" />' +
						'<a href="/release/'+$(this).attr('href')+'" target="_blank">'+$(this).children('strong').text() +'</a>' +
						'<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
						'</div>'
				);
			});

			//---------------------------

			$('#artist_search_list').btsListFilter('#artist_search', {
				sourceTmpl: '<a class="list-group-item artist_search_item" href="{id}"><strong>{name}</strong> type:{type} gender:{gender}</a>',
				sourceData: function(text, callback) {
					return $.getJSON('/artist/search/'+text, function(json) {
						callback(json);
					});
				}
			});

			$('#artist_search_list').on('click','a',function(e){
				e.preventDefault();

				$('#artist_selected').append(
						'<div class="row">' +
						'<input type="hidden" value="'+$(this).attr('href')+'" name="artist_id[]" />' +
						'<a href="/artist/'+$(this).attr('href')+'" target="_blank">'+$(this).children('strong').text() +'</a>' +
						'<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
						'</div>'
				);
			});

			//---------------------------

			$('#track_search_list').btsListFilter('#track_search', {
				sourceTmpl: '<a class="list-group-item track_search_item" href="{id}"><strong>{name}</strong> - {release} - <i>{artist}</i></a>',
				sourceData: function(text, callback) {
					return $.getJSON('/track/search/'+text, function(json) {
						callback(json);
					});
				}
			});

			$('#track_search_list').on('click','a',function(e){
				e.preventDefault();

				$('#track_selected').append(
						'<div class="row">' +
						'<input type="hidden" value="'+$(this).attr('href')+'" name="track_id[]" />' +
						'<a href="/track/'+$(this).attr('href')+'" target="_blank">'+$(this).children('strong').text() +'</a>' +
						'<button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
						'</div>'
				);
			});

			//---------------------------

			$('#artist_selected, #release_selected, #track_selected').on('click','button.close',function(e){
				$(this).parent().remove();
			});

		});
	</script>
@stop