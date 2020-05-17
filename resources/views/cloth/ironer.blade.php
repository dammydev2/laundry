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

		<div class="panel panel-primary col-xs-4">
			<div class="panel-heading">Search Tag</div>
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
				
				<form method="post" action="ironertag">
					
					{{ csrf_field() }}

					<div class="form-group">
						<label>Tag <i class="fa fa-tag"></i></label>
						<input type="text" name="tag" class="form-control">
					</div>

					<input type="submit" name="submit" value="search Tag" class="btn btn-primary">

				</form>

			</div>
			
		</div>

	</div>
</div>
@endsection
