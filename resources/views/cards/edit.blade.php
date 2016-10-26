@extends('layouts.app')

@section('content')

			<h2>Edit the card</h2>

			<form method="POST" action="/cards/{{ $card->id }}">
				
				{{ method_field	('PATCH') }}

				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				
				<div class="form-group">
					<textarea name="title" class="form-control">{{ $card->title }}</textarea>
				</div>

				<div class="form-group">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>

			</form>

@stop
