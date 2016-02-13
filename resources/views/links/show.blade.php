@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $link->name }}</h1>
            <p>{{ $link->bio }}</p>
        </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2>
					{{ $link->caption }}
					@can('admin')
					<div class="btn-group pull-right">
						{{ Html::linkRoute('link.edit', trans('htmusic.edit'), ['link' => $link->id], ['class' => 'btn btn-default glyphicons-edit']) }}
						{{ Html::linkRoute('link.destroy', trans('htmusic.delete'), ['link' => $link->id], ['class' => 'btn btn-default', 'data-confirm' => trans('htmusic.are_you_sure'), 'data-token' => csrf_token(),'data-method' => 'DELETE']) }}
					</div>
					@endcan
					</h2>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.caption') }}:</div>
						<div class="col-md-10">{{ $link->caption }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.description') }}:</div>
						<div class="col-md-10">{{ $link->description }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.url') }}:</div>
						<div class="col-md-10">{{ Html::link( $link->url,$link->url,['target' => '_blank']) }}</div>
					</div>
					<div class="row">
						@if($link->artists()->count() > 0)
							<div class="col-md-2">{{ trans('htmusic.artists') }}:</div>
							<div class="col-md-10">
								@foreach($link->artists as $n => $row)
									{{ Html::linkRoute('artist.show', $row->name, [$row->id]) }} @if(isset($row->name[$n + 1]))<br />@endif
								@endforeach
							</div>
						@endif
					</div>
					<div class="row">
						@if($link->releases()->count() > 0)
							<div class="col-md-2">{{ trans('htmusic.releases') }}:</div>
							<div class="col-md-10">
								@foreach($link->releases as $n => $row)
									<a href="{{ route('release.show', [$row->id]) }}" target="_blank">{{ $row->name }}, <i>{{ $row->credit->name }}</i></a> @if(isset($row->name[$n + 1]))<br />@endif
								@endforeach
							</div>
						@endif
					</div>
					<div class="row">
						@if($link->tracks()->count() > 0)
							<div class="col-md-2">{{ trans('htmusic.tracks') }}:</div>
							<div class="col-md-10">
								@foreach($link->tracks as $n => $row)
									<a href="{{ route('track.show', [$row->id]) }}" target="_blank">{{ $row->name }} - {{ $row->release->name }}, <i>{{ $row->credit->name }}</i></a> @if(isset($row->name[$n + 1]))<br />@endif
								@endforeach
							</div>
						@endif
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