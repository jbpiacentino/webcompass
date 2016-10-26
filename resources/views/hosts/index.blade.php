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

	
	<h2>All hosts</h2>

	<div class="row">
		<form class="navbar-form navbar-left" action="{{ action('HostsController@index') }}">
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
							<a href="{{ action( 'HostsController@index', [
									'sort' => 'host', 
									'order' => 'asc'
								]) }}">
								<strong>Host</strong>
							</a>
						</th>
						<th>
							<a href="{{ action( 'HostsController@index', [
									'sort' => 'places', 
									'order' => 'desc'
								]) }}">
								Places
							</a>
						</th> 
						<th>
							<a href="{{ action( 'HostsController@index', [
									'sort' => 'visits', 
									'order' => 'desc'
								]) }}">
								Visits
							</a>
						</th>
					</tr> 
				</thead>
				@foreach($hosts as $host)	
					<tbody>
						<tr> 
							<td >
								<a href="#{{$host->id}}_places" data-toggle="collapse">
									{{ $host->host}} 
								</a>			
							</td> 
							<td>
								{{ $host->places->count() }}
							</td>
							<td>
								{{ $host->visits()->count() }}
							</td>
						</tr>
						<tr>
							<td colspan="3" style="border-top:0px;padding:0px;">
								<div id="{{ $host->id }}_places" class="collapse">
									@include('hosts.places', ['places' => $host->places])
								</div>
							</td>
						</tr>
					</tbody>
				@endforeach			
			</table>
			@endif
			{{ $hosts->appends([
					'sort' => Request::query('sort', 'frecency'),
					'order' => Request::query('order', 'asc')])
				->links() }}
		</div>
	</div>

@endsection