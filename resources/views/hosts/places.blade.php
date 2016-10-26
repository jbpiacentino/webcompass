
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
				Visits
			</th>
			<th>
				Query params
			</th>
		</tr> 
	</thead>
	<tbody>
		@foreach($places as $place)	
			<tr> 
				<td> 
					@if($place->title) 
						<a href="#" data-toggle="tooltip" title="{{$place->path}}">{{$place->title}}</a>
					@else
						({{$place->path}})
					@endif
					</br>
				</td> 
				
				<td> {{ $place->visits->count() }}</td>
				<td> 
					@foreach($place->queries as $query)
						
						<a href="#" data-toggle="tooltip" title="{{$query->value}}">{{$query->key}}</a></br>
					@endforeach
				</td>
			</tr>
		@endforeach						
	</tbody>
</table>
