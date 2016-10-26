@extends('layouts.app')

@section('content')


	
			<h2>All cards</h2>
			<div class="panel panel-default">
				<div class="panel-body">

					<ul class="list-group">
						@if (!empty($cards)) 
							@foreach($cards as $card)							
								<li class="list-group-item">
									 <a href="/cards/{{ $card->id }}">{{ $card->title }}</a> 
									 <span class="pull-right")>
									 	(<a href='{{ url("/user/$card->user_id") }}'>{{ $card->user->name }}</a>)
									 </span>
								</li>
							@endforeach			
						@endif
						{{ $cards->links() }}
					</ul>
					

					<form class="form-inline {{ $errors->has('title') ? ' has-error' : '' }}" role="form" method="POST" action="/cards">
						{{ csrf_field() }}						

						<div class="form-group" style="width:100%">

							<input name="title" class="form-control" placeholder="New card title" value="{{ old('title') }}"></input>
							<button type="submit" class="btn btn-primary">Add Card</button>			
						</div>
					</form>
					@if ($errors->has('title'))
                        <span class="help-block">
							<strong>{{ $errors->first('title') }}</strong>
						</span>
					@endif
				</div>
			</div>	


	<!-- @if(count($errors)) 
	<ul>	
		@foreach ($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>
	@endif
 -->
@stop
