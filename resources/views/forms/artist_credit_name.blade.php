@extends('layouts.app')

@section('content')
{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('artist_credit', 'Artist_credit:') !!}
			{!! Form::text('artist_credit') !!}
		</li>
		<li>
			{!! Form::label('position', 'Position:') !!}
			{!! Form::text('position') !!}
		</li>
		<li>
			{!! Form::label('artist_id', 'Artist_id:') !!}
			{!! Form::text('artist_id') !!}
		</li>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('join_phrase', 'Join_phrase:') !!}
			{!! Form::text('join_phrase') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
@stop