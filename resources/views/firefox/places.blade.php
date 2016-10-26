
<table class="table">
	<thead>
		<tr> 
			<th>
				<a href="{{ action( 'PlacesController@index', [
						'sort' => 'title', 
						'order' => 'asc',
						'host' => Request::query('host')
					]) }}">
					<strong>Title</strong>
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
				Visits
			</th>
			<th>
				Query params
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
	<tbody>
		@foreach($places as $place)	
			<tr> 
				<td> {{ $place->title}} </td> 
				<td> {{ $place->split_url['path'] }} </td>
				<td> {{ $place->visit_count }}</td>
				<td> 
					@if(!empty($place->split_url['query']))
						@foreach($place->split_url['query'] as $key => $value)
							<a href="#" data-toggle="tooltip" title="{{$value}}">{{$key}}</a></br>
						@endforeach
					@endif
				</td>
				<td> {{ $place->frecency }} </td>
			</tr>
		@endforeach						
	</tbody>
</table>
