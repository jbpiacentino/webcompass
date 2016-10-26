

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

	<form class="form-inline" method="post" enctype="multipart/form-data" action="{{ action('FirefoxController@upload') }}">
		{{ csrf_field() }}	
		<div class="form-group">
			<label for="mozplaces">Firefox Places sqlite database</label>
			<input type="file" id="mozplaces" name="mozplaces"  value="{{ old('mozplaces')}}">
			<p class="help-block">Select your Firefox places.sqlite file.</p>
		</div>
		<button type="submit" class="btn btn-default">Upload</button>

	</form>

