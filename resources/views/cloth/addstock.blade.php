@extends('layouts.app')

@section('content')

<script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>
<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>

<div class="container">
	<div class="row">

		@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
		@endif

		@if(Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif

		<div class="panel panel-primary col-xs-4">
			<div class="panel-heading">Add Stock</div>
			<div class="panel-body">

				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				
				<form method="post" action="searchcustomer">
					
					{{ csrf_field() }}

					<div class="form-group">
					<select class="js-example-basic-single col-xs-12 form-control" name="customer">
						<option value="">Select Customer</option>
						@foreach($data as $row)
						<option value="{{ $row->cus_id }}">{{ $row->name }} ({{ $row->cus_id }})</option>
						@endforeach

					</select>
				</div>

					<input type="submit" name="submit" value="Continue" class="btn btn-primary">

				</form>

			</div>

		</div>

	</div>
</div>

<script type="text/javascript">
	// In your Javascript (external .js resource or <script> tag)
	$(document).ready(function() {
		$('.js-example-basic-single').select2();
	});
</script>
@endsection
