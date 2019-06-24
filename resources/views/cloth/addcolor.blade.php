@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-4 panel panel-primary">
			<div class="panel-heading">Add New Color</div>
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

				<form method="post" action="{{ url('/entercolor') }}">

					{{ csrf_field() }}

					<div class="form-group">
						<label>Color Name</label>
						<input type="text" name="color" class="form-control" placeholder="e.g. Green">
					</div>

					<input type="submit" name="submit" class="btn btn-primary">

				</form>

			</div>
		</div>

	</div>
</div>
@endsection
