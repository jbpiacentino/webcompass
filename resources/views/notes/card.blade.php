@extends('layouts.app')

@section('content')

	<h1>All notes</h1>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<ul class="list-group">
				@foreach($notes as $note)
					<li class="list-group-item">{{ $note->title }}</li>
				@endforeach			
			</ul>
		</div>
	</div>	

	<hr></hr>
	<h3>Add a note</h3>
	
	<form method="POST" action="/notes/{{ $note->id }}/notes">

		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<div class="form-group">
			<textarea name="body" class="form-control"></textarea>
		</div>

		<div class="form-group">
			<button type="submit" class="btn btn-primary">Add Note</button>
		</div>

	</form>
@stop
