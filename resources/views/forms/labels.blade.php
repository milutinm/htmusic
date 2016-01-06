@extends('layouts.app')

@section('content')
{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
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
			{!! Form::label('description', 'Description:') !!}
			{!! Form::textarea('description') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
@stop