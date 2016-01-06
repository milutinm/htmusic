@extends('layouts.app')

@section('content')
{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('genre_id', 'Genre_id:') !!}
			{!! Form::text('genre_id') !!}
		</li>
		<li>
			{!! Form::label('release_id', 'Release_id:') !!}
			{!! Form::text('release_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
@stop