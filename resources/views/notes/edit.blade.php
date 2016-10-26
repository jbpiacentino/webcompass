@extends('layouts.app')

@section('content')


	<h2>Edit the note</h2>

	<form method="POST" action="/notes/{{ $note->id }}">
		
		{{ method_field	('PATCH') }}

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<div class="form-group">
			<textarea name="body" class="form-control">{{ $note->body }}</textarea>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Update the note</button>
		</div>

	</form>


@stop
