@extends('layouts.app')


@section('content')

<div id="div1"><h2>Let jQuery AJAX Change This Text</h2></div>
<button>Get External Content</button>	
@endsection


@section ('endscripts')

<script src="/js/jquery.min.js"></script>

<script>


$("button").click(function(){

    $.ajax({
    	url: "/firefox/updateStatus", 
    	type: "GET",
    	data: { '_token': '{{ csrf_token() }}' },
    	success: function(result) {
        	$("#div1").html(result.time.date);
    	}
    });
});
</script>

@endsection
