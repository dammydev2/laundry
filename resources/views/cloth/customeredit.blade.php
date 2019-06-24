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
			<div class="panel-heading">Edit Customer</div>
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
				
				<form method="post" action="{{ url('updatecustomer') }}">
					
					{{ csrf_field() }}

					@foreach($data as $row)

					<div class="form-group">
						<label>Customer name</label>
						<input type="text" value="{{ $row->name }}" name="name" class="form-control">
					</div>

					<div class="form-group">
						<label>Customer email</label>
						<input type="text" name="email" value="{{ $row->email }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Customer address</label>
						<input type="text" name="address" value="{{ $row->address }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Customer phone</label>
						<input type="text" name="phone" value="{{ $row->phone }}" class="form-control">
					</div>

					<input type="hidden" name="cus_id" value="{{ $row->cus_id }}">

					@endforeach

					<input type="submit" name="update" class="btn btn-primary">

				</form>

			</div>
			
		</div>

	</div>
</div>
@endsection
