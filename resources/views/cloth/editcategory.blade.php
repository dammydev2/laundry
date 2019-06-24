@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<div class="col-sm-4 panel panel-primary">
			<div class="panel-heading">Update Category</div>
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

				<form method="post" action="{{ url('/categoryedit') }}">

					{{ csrf_field() }}

					@foreach($data as $row)
					<div class="form-group">
						<label>Category Name</label>
						<input type="text" name="category" value="{{ $row->category }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Expected qty of clothes in categoty</label>
						<input type="number" name="qty" placeholder="e.g. (if category is Agbada, then this is 3)" value="{{ $row->qty }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Amount Washed</label>
						<input type="text" name="amount" value="{{ $row->amount }}" class="form-control">
					</div>

					<input type="hidden" name="id" value="{{ $row->id }}">
					@endforeach

					<input type="submit" name="submit" class="btn btn-primary">

				</form>

			</div>
		</div>

	</div>
</div>
@endsection
