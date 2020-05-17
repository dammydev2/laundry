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
			<div class="panel-heading">Return Stock</div>
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
				
				<form method="post" action="searchtag">
					
					{{ csrf_field() }}

					<div class="form-group">
						<label>Tag <i class="fa fa-tag"></i></label>
						<select class="form-control js-example-basic-single" name="tag">
						    <option value="">Search using customer name or tag</option>
						    @foreach($data as $row)
						    <option value="{{ $row->tag }}">{{ $row->name. ' ('.$row->created_at.')' }}</option>
						    @endforeach
						</select>
						<!--input type="text" name="tag" class="form-control">-->
					</div>

					<input type="submit" name="submit" value="search Tag" class="btn btn-primary">

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
