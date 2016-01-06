@extends('layouts.app')

@section('content')
{!! Form::open(array('route' => 'route.name', 'method' => 'POST')) !!}
	<ul>
		<li>
			{!! Form::label('artist_credit_id', 'Artist_credit_id:') !!}
			{!! Form::text('artist_credit_id') !!}
		</li>
		<li>
			{!! Form::label('medium_id', 'Medium_id:') !!}
			{!! Form::text('medium_id') !!}
		</li>
		<li>
			{!! Form::label('release_status_id', 'Release_status_id:') !!}
			{!! Form::text('release_status_id') !!}
		</li>
		<li>
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name') !!}
		</li>
		<li>
			{!! Form::label('barcode', 'Barcode:') !!}
			{!! Form::text('barcode') !!}
		</li>
		<li>
			{!! Form::label('date', 'Date:') !!}
			{!! Form::text('date') !!}
		</li>
		<li>
			{!! Form::label('notes', 'Notes:') !!}
			{!! Form::textarea('notes') !!}
		</li>
		<li>
			{!! Form::submit() !!}
		</li>
	</ul>
{!! Form::close() !!}
@stop