@extends('layouts.app')

@section('content')


			<h2>{{ $card->title}}
				@can('update', $card)
					<a href="/cards/{{ $card->id }}/edit" class="btn btn-xs btn-default">
						<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
					</a>
				@endcan
				@can('delete', $card)
					<div class="pull-right">
				    	<a href="javascript:void(0);" class="btn btn-xs alert-danger" onclick="$(this).find('form').submit();" >
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
						    <form action="/cards/{{ $card->id }}" method="post">
						        {{ method_field	('DELETE') }}
						        <input type="hidden" name="_token" value="{{ csrf_token() }}">
						    </form>
						</a>					
					</div>
				@endcan
			</h2>
			
			<hr></hr>

			<div class="row">
				<ul class="list-group">
					@foreach($card->notes as $note)
						<li class="list-group-item">
							{{ $note->body }}
							<div class="pull-right">
								@can('update', $note)
									<a href="/notes/{{ $note->id }}/edit" class="btn btn-xs btn-default">
										<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									</a>
								@endcan
								@can('delete', $note)
									<a href="javascript:void(0);" class="btn btn-xs alert-danger" onclick="$(this).find('form').submit();" >
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
										    <form action="/notes/{{ $note->id }}" method="post">
										        {{ method_field	('DELETE') }}
										        <input type="hidden" name="_token" value="{{ csrf_token() }}">
										    </form>
										</a>					
									
								@endcan
							</div>
						</li>
					@endforeach			
				</ul>
			</div>

			<div class="row">
				<h3>Add a note</h3>
				<form method="POST" action="/cards/{{ $card->id }}/note">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="form-group">
						<textarea name="body" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Add Note</button>
					</div>
				</form>
			</div>

@stop
