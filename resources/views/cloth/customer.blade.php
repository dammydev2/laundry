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

		<div class="col-sm-10">
			<table class="table table-bordered" border="1">
				<tr>
					<td><a href="{{ url('addcustomer') }}" class="btn btn-primary fa fa-plus">Add New Customer</a></td>
				</tr>
				<tr>
					<th>Customer ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Address</th>
					<th></th>
					<th></th>
				</tr>

				@foreach($data as $row)
				<tr>
					<td>{{ $row->cus_id }}</td>
					<td>{{ $row->name }}</td>
					<td>{{ $row->email }}</td>
					<td>{{ $row->phone }}</td>
					<td>{{ $row->address }}</td>
					<td><a href="{{ url('customeredit/'.$row->id) }}">Edit</a></td>
					<td><a href="{{ url('customerdelete/'.$row->id) }}"><i class="fa fa-trash btn btn-danger"></i></a></td>
				</tr>
				@endforeach
				
			</table>
		</div>

	</div>
</div>
@endsection
