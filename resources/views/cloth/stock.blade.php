@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</td></div>
		@endif

		@if(Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</td></div>
		@endif

		<div class="" >
			<table class="table table-bordered" border="1" style="overflow-y: scroll;">
				<tr>
					<td><a href="{{ url('addstock') }}" class="btn btn-primary fa fa-plus">Add New Stock</a></td>
				</tr>
				<tr>
					<th>Tag</th>
					<th>Breakdown</th>
				</tr>

				@foreach($data as $row)
				<tr>
					<td>{{ $row->tag }}</td>
					<td><a href="{{ url('/breakdown/'.$row->tag) }}">Breakdown</a></td>
				</tr>
				<?php //$sum += $total ?>
				@endforeach


			</table>
		</div>

	</div>
</div>
@endsection
