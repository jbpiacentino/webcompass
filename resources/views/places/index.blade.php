@extends('layouts.app')


@section('content')

	<div class="flash-message">
		@if (count($errors) > 0)
			@foreach ($errors->all() as $error)
				<p class="alert alert-danger"> {{ $error }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</p>
			@endforeach
		@endif

		@foreach (['danger', 'warning', 'success', 'info'] as $msg)
			@if(Session::has($msg))
				<p class="alert alert-{{ $msg }}">{{ Session::get($msg) }}
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				</p>
			@endif
		@endforeach
	</div>
	
	<h2>
		@if(Request::query('host'))
			Places for {{ Request::query('host') }}
		@else
			All places
		@endif
	</h2>
	<div class="row">
		<form class="navbar-form navbar-left" action="{{ action('FirefoxController@index') }}">
			<div class="form-group">
	        	<input type="text" class="form-control" id="host" name="host" placeholder="Search" value="{{Request::query('host')}}" >
	        </div>
	        <button type="submit" class="btn btn-default">Search</button>
    	</form>
    </div>
	
	<div class="panel panel-default">
		<div class="panel-body">



			@if (!empty($places)) 
				<table class="table">
					<thead>
						<tr> 
							<th>
								<a href="{{ action( 'PlacesController@index', [
										'sort' => 'title', 
										'order' => 'asc',
										'host' => Request::query('host')
									]) }}">
									<strong>Host</strong>
								</a>
							</th>
							<th>
								<a href="{{ action( 'PlacesController@index', [
										'sort' => 'url', 
										'order' => 'asc',
										'host' => Request::query('host')
									]) }}">
									Path
								</a>
							</th>
							<th>
								Query params
							</th>
							<th>
								Visits
							</th>
							<th>
								<a href="{{ action( 'PlacesController@index', [
										'sort' => 'frecency', 
										'order' => 'desc',
										'host' => Request::query('host')
									]) }}">
									Frecency
								</a>
							</th> 
						</tr> 
					</thead>
					@foreach($places as $place)	
						<tbody>
							<tr> 
								<td> {{ $place->host->host }} </td>
								<td> {{ $place->title}} </td> 
								<td> {{ $place->url }}</td>
								<td> 
									@if(!empty($place->split_url['query']))
										@foreach($place->split_url['query'] as $key => $value)
											<a href="#" data-toggle="tooltip" title="{{$value}}">{{$key}}</a></br>
										@endforeach
									@endif
								</td>
								<td> {{ $place->frecency }} </td>
							</tr>
						</tbody>
					@endforeach						
				</table>
				{{ $places->appends([
					'host' => Request::query('host', ''),
					'sort' => Request::query('sort', 'host'), 
					'order' => Request::query('order', 'asc'),
					])->links() }}

			@endif
		</div>
	</div>

@endsection