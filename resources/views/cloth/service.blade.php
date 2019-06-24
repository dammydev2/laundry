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

		<div class="col-sm-8">
			<table class="table table-bordered">
				<tr>
					<td colspan="5"><center><h4>Additional Services</h4></center></td>
				</tr>
				<tr>
					<td><a href="{{ url('addservice') }}" class="btn btn-primary fa fa-plus">Add New Service</a></td>
				</tr>
				<tr>
					<th>Service Type</th>
					<th>Amount</th>
					<th></th>
					<th></th>
				</tr>

				@foreach($data as $row)
				<tr>
					<th>{{ $row->service }}</th>
					<th>{{ $row->price }}</th>
					<th><a href="{{ url('editservices/'.$row->id) }}">Edit</a></th>
					<th><a href="{{ url('deleteservice/'.$row->id) }}"><i class="fa fa-trash btn btn-danger"></i></a></th>
				</tr>
				@endforeach
				
			</table>
		</div>

	</div>
</div>
@endsection
