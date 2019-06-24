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

		<div class="col-sm-5">
			<table class="table table-bordered">
				<tr>
					<td><a href="{{ url('addcolor') }}" class="btn btn-primary fa fa-plus">Add New Color</a></td>
				</tr>
				<tr>
					<th>Color Name</th>
					<th></th>
					<th></th>
				</tr>

				@foreach($data as $row)
				<tr>
					<th>{{ $row->color }}</th>
					<th><a href="{{ url('editcolor/'.$row->id) }}">Edit</a></th>
					<th><a href="{{ url('deletecolor/'.$row->id) }}"><i class="fa fa-trash btn btn-danger"></i></a></th>
				</tr>
				@endforeach
			</table>
		</div>

	</div>
</div>
@endsection
