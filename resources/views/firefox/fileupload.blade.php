@section('style')
	<link rel="stylesheet" href="css/jquery-fileupload/style.css">
	<link rel="stylesheet" href="css/jquery-fileupload/jquery.fileupload.css">
@endsection


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

<span class="btn btn-success fileinput-button">
    <i class="glyphicon glyphicon-plus"></i>
    <span>Select the Frefox places.sqlite file...</span>
    <input id="fileupload" type="file" name="files[]">
</span>

<br>
<br>
<div id="progress" class="progress">
    <div class="progress-bar progress-bar-success"></div>
</div>
<!-- The container for the uploaded files -->
<div id="files" class="files"></div>
<br>

@section('endscripts')

	<script src="js/jquery.min.js"></script>
	<script src="js/jquery-fileupload/vendor/jquery.ui.widget.js"></script>
	<script src="js/jquery-fileupload/jquery.iframe-transport.js"></script>
	<script src="js/jquery-fileupload/jquery.fileupload.js"></script>

	<script>

		/*jslint unparam: true */
		/*global window, $ */
		$(function () {
		    'use strict';

		    var url = 'server/php/';

		    $('#fileupload').fileupload({

		    	maxChunkSize: 10000000, // 10 MB
		        url: url,
		        dataType: 'json',
				redirect: '/?%s',

		        done: function (e, data) {
		            $.each(data.result.files, function (index, file) {
		                $('<p/>').text(file.name).appendTo('#files');
		                $('<p/>').text(JSON.stringify(file)).appendTo('#files');
		                window.location="/firefox/import?places=" + file.name;
		            });
		            
		        },

		        progressall: function (e, data) {
		            var progress = parseInt(data.loaded / data.total * 100, 10);
		            $('#progress .progress-bar').css(
		                'width',
		                progress + '%'
		            );
		        }

		    }).prop('disabled', !$.support.fileInput)
		        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		});
	</script>

@endsection