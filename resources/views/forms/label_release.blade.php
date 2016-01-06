@extends('layouts.app')

@section('content')
{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('release_id', 'Release_id:') !!}
			{!! Form::text('release_id') !!}
		</li>
		<li>
			{!! Form::label('label_id', 'Label_id:') !!}
			{!! Form::text('label_id') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
@stop