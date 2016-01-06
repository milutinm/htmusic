@extends('layouts.app')

@section('content')
{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('artist_id', 'Artist_id:') !!}
			{!! Form::text('artist_id') !!}
		</li>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('sort_name', 'Sort_name:') !!}
			{!! Form::text('sort_name') !!}
		</li>
		<li>
			{!! Form::label('type_id', 'Type_id:') !!}
			{!! Form::text('type_id') !!}
		</li>
		<li>
			{!! Form::label('begin_date', 'Begin_date:') !!}
			{!! Form::text('begin_date') !!}
		</li>
		<li>
			{!! Form::label('is_ended', 'Is_ended:') !!}
			{!! Form::text('is_ended') !!}
		</li>
		<li>
			{!! Form::label('end_date', 'End_date:') !!}
			{!! Form::text('end_date') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
@stop