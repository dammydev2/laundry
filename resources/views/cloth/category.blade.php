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
					<td><a href="{{ url('addcategory') }}" class="btn btn-primary fa fa-plus">Add New Category</a></td>
				</tr>
				<tr>
					<th>Category</th>
					<th>Amount</th>
					<th>Expected Qty</th>
					<th></th>
					<th></th>
				</tr>
				@foreach($data as $row)
				<tr>
					<th>{{ $row->category }}</th>
					<th>{{ $row->amount }}</th>
					<th>{{ $row->qty }}</th>
					<th><a href="{{ url('editcategory/'.$row->id) }}">Edit</a></th>
					<th><a href="{{ url('deletecategory/'.$row->id) }}"><i class="fa fa-trash btn btn-danger"></i></a></th>
				</tr>
				@endforeach
			</table>
		</div>

	</div>
</div>
@endsection
