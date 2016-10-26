@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('css/jquery-fileupload/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery-fileupload/jquery.fileupload.css') }}">
@endsection

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

    <div class="panel panel-default">
        <div class="panel-heading">Firefox places import</div>
        <div class="panel-body">
            
            @if(Auth::user()->import_progress == -1)
                You have not imported records yet.
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>{{trans('site.addfile')}}...</span>
                            <!-- The file input field used as target for the file upload widget -->
                        <form id="fileupload">
                            <input id="filew" type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input name="files[]" multiple="" type="file">
                        </form>
                    </span>

                    
                    <div id="uploadprogress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>

            @elseif (Auth::user()->import_progress < 100)
                Your Firefox database import is in progress 
               
            @else 
                {{ Auth::user()->places()->count() }} records have been imported.
            @endif
			
        </div>
         <span id='import_progress'>ABC</span>

    </div>

@endsection

@section('endscripts')
<script src="{{ asset('js/jquery.min.js')}}"></script>
<script src="{{ asset('js/jquery-fileupload/vendor/jquery.ui.widget.js') }}"></script>
<script src="{{ asset('js/jquery-fileupload/jquery.iframe-transport.js') }}"></script>
<script src="{{ asset('js/jquery-fileupload/jquery.fileupload.js') }}"></script>

<script>

    /*jslint unparam: true */
    /*global window, $ */
    $(function () {
        'use strict';

        var url = '/server/php/';

        $('#fileupload').fileupload({

            maxChunkSize: 1000000, // 1 MB
            url: url,
            dataType: 'json',
            redirect: '/?%s',

            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (file.url) {
                        $.ajax({
                                url: "/firefox/importMozPlaces", 
                                type: "GET",
                                data: { '_token': '{{ csrf_token() }}', 'file': file },
                                success: function (result) {    
                                    
                                }
                            });
                        // setInterval( function () { 
                        //     $.ajax({
                        //         url: "/firefox/importProgress", 
                        //         type: "GET",
                        //         data: { '_token': '{{ csrf_token() }}' },
                        //         success: function (result) {    
                        //             if (result.progress) $("#import_progress").text('('+result.progress+'%)');
                        //         }
                        //     });
                        // }, 5000);
                    }
                    else if (file.error) {
                        alert('error');
                        // var error = $('<span class="text-danger"/>').text(file.error);
                        // $(data.context.children()[index])
                        //     .append('<br>')
                        //     .append(error);
                    }
                    //window.location="/firefox/import?places=" + file.name;
                });
                
            },

            progressall: function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#uploadprogress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }

        })
        .prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });
</script>

@endsection
