@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $image->name }}</h1>
            <p>{{ $image->bio }}</p>
        </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="panel panel-default">
				<div class="panel-heading collapse navbar-collapse">
					<h2>
					{{ $image->caption }}
					@can('admin')
						<div class="dropdown  pull-right">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="glyphicon glyphicon-wrench"></span>
								<span class="caret"></span>
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
								<li>{{ Html::linkRoute('image.edit', trans('htmusic.edit'), ['image' => $image->id]) }}</li>
								<li>{{ Html::linkRoute('image.destroy', trans('htmusic.delete'), ['image' => $image->id], ['data-confirm' => trans('htmusic.are_you_sure'), 'data-token' => csrf_token(),'data-method' => 'DELETE']) }}</li>
							</ul>
						</div>
					@endcan
					</h2>
				</div>
				<div class="panel-body">
					<div class="row">
						{{ Html::image(URL::route('image.display', $image->id), $image->caption, ['class' => 'img-thumbnail img-responsive']) }}
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.caption') }}:</div>
						<div class="col-md-10">{{ $image->caption }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.description') }}:</div>
						<div class="col-md-10">{{ $image->description }}</div>
					</div>
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.path') }}:</div>
						<div class="col-md-10">{{ $image->path }}</div>
					</div>
					@if(isset($image->source) && $image->source != '')
					<div class="row">
						<div class="col-md-2">{{ trans('htmusic.url') }}:</div>
						<div class="col-md-10">{{ Html::link( $image->source,$image->source,['target' => '_blank']) }}</div>
					</div>
					@endif
					<div class="row">
						@if($image->artists()->count() > 0)
							<div class="col-md-2">{{ trans('htmusic.artists') }}:</div>
							<div class="col-md-10">
								@foreach($image->artists as $n => $row)
									{{ Html::linkRoute('artist.show', $row->name, [$row->id]) }} @if(isset($row->name[$n + 1]))<br />@endif
								@endforeach
							</div>
						@endif
					</div>
					<div class="row">
						@if($image->releases()->count() > 0)
							<div class="col-md-2">{{ trans('htmusic.releases') }}:</div>
							<div class="col-md-10">
								@foreach($image->releases as $n => $row)
									<a href="{{ route('release.show', [$row->id]) }}" target="_blank">{{ $row->name }}, <i>{{ $row->credit->name }}</i></a> @if(isset($row->name[$n + 1]))<br />@endif
								@endforeach
							</div>
						@endif
					</div>
					<div class="row">
						@if($image->tracks()->count() > 0)
							<div class="col-md-2">{{ trans('htmusic.tracks') }}:</div>
							<div class="col-md-10">
								@foreach($image->tracks as $n => $row)
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