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

	<form method="POST" role="form" enctype="multipart/form-data" action="fileUpload">
		{{ csrf_field() }}	
		<div class="row cancel">
			<div class="col-md-4">
				<label for="image">Image File</label>
				<input type="file" id="image" name="image"  value="{{ old('image')}}">
				<p class="help-block">Select your image.</p>
			</div>

			<div class="col-md-4">
				<button type="submit" class="btn btn-success">Create</button>
			</div>
		</div>
	</form>


@endsection