@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-4 panel panel-primary">
			<div class="panel-heading">Add New Category</div>
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

				<form method="post" action="{{ url('/entercategory') }}">

					{{ csrf_field() }}

					<div class="form-group">
						<label>Category Name</label>
						<input type="text" name="category" class="form-control" placeholder="e.g. Agbada">
					</div>

					<div class="form-group">
						<label>Expected qty of clothes in categoty</label>
						<input type="number" name="qty" placeholder="e.g. (if category is Agbada, then this is 3)" class="form-control">
					</div>

					<div class="form-group">
						<label>Amount Washed</label>
						<input type="text" name="amount" class="form-control">
					</div>

					<input type="submit" name="submit" class="btn btn-primary">

				</form>

			</div>
		</div>

	</div>
</div>
@endsection
