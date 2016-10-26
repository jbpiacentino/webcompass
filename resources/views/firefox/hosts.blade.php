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
	
	<h2>Firefox hosts</h2>
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
				@if (!empty($hosts)) 
				<table class="table">
					<thead>
						<tr> 
							<th>
								<a href="{{ action( 'FirefoxController@index', [
										'sort' => 'host', 
										'order' => (Request::query('sort') == 'host') 
														? (Request::query('order') == 'asc' 
															? 'desc' 
															: 'asc') 
														: 'asc'
									]) }}">
									<strong>Host</strong>
								</a>
							</th>
							<th>
								<strong>Visits</strong>
							</th>
							<th>
								<a href="{{ action( 'FirefoxController@index', [
										'sort' => 'frecency', 
										'order' => (Request::query('sort') == 'frecency') 
														? (Request::query('order') == 'asc' 
															? 'desc' 
															: 'asc') 
														: 'asc'
									]) }}">
									Frecency
								</a>
							</th> 
						</tr> 
					</thead>
					<tbody>
						@foreach($hosts as $host)	
							<tr> 
								<td >
									<a href="#{{$host->id}}_places" data-toggle="collapse">
										{{ $host->host}} 
									</a>
								</td> 
								<td> {{ $host->places->count() }}</td>
								<td> {{ $host->frecency }} </td>
							</tr>
							<tr>
								<td colspan="3" style="border-top:0px;padding:0px;">
									<div id="{{ $host->id }}_places" class="collapse">
										@include('firefox.places', ['places' => $host->places])
									</div>
								</td>
							</tr>
						@endforeach			
					</tbody>
					
				</table>
				@endif
				{{ $hosts->appends([
						'sort' => Request::query('sort', 'frecency'),
						'order' => Request::query('order', 'asc')])
					->links() }}
			</div>
		</div>

@endsection