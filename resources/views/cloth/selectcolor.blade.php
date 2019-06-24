@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
		@endif

		@if(Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif

		<div class="col-sm-5">

			<button id="Add">Click to add textbox</button> <button id="Remove">Click to remove textbox</button>  

			<div id="textboxDiv"></div> 

		</div>

	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>  
	$(document).ready(function() {  
		$("#Add").on("click", function() {  
			$("#textboxDiv").append("<div class='row'><div class='form-group'><select class='form-control col-sm-4' name='color[]'>@foreach($data as $row) <option>{{ $row->color }}</option>@endforeach</select> <input type='text' name='skill[]' class='form-control col-sm-4' placeholder=''/></div></div>");  
		});  
		$("#Remove").on("click", function() {  
			$("#textboxDiv").children().last().remove();  
		});  
	});  
</script> 
@endsection
