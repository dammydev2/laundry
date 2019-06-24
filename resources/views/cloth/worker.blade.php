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
					<td><a href="{{ url('addworker') }}" class="btn btn-primary fa fa-plus">Add New worker</a></td>
				</tr>
				<tr>
					<th>Name</th>
					<th>Email</th>
					<th></th>
					<th></th>
				</tr>
				@foreach($data as $row)
				<tr>
					<th>{{ $row->name }}</th>
					<th>{{ $row->email }}</th>
					<th><a href="{{ url('editworker/'.$row->id) }}">Edit</a></th>
					
@if($row->type != 0)
					<th><a href="{{ url('deleteworker/'.$row->id) }}"><i class="fa fa-trash btn btn-danger"></i></a></th>
					@endif
				</tr>
				@endforeach
				
			</table>
		</div>

	</div>
</div>
@endsection
