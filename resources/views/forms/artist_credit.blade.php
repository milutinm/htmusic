@extends('layouts.app')

@section('content')
{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('artist_count', 'Artist_count:') !!}
			{!! Form::text('artist_count') !!}
		</li>
		<li>
			{!! Form::label('ref_count', 'Ref_count:') !!}
			{!! Form::text('ref_count') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
@stop