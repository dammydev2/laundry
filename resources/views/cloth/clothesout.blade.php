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
			<div class="panel-heading">Clothes Brought Out</div>
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
				
				<form method="post" action="searchclothesout">
					
					{{ csrf_field() }}

					<div class="form-group">
						<label>Start data <i class="fa fa-calendar"></i></label>
						<input type="date" name="start_date" class="form-control">
					</div>

					<div class="form-group">
						<label>End data <i class="fa fa-calendar"></i></label>
						<input type="date" name="end_date" class="form-control">
					</div>

					<input type="submit" name="submit" value="Generate Report" class="btn btn-primary">

				</form>

			</div>
			
		</div>

	</div>
</div>
@endsection
