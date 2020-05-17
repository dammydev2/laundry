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
			<div class="panel-heading">Ironers for tag {{ Session::get('tag') }}</div>
			<div class="panel-body">				
				
				<table class="table table-bordered">
					<tr>
						<th>Tag no</th>
						<th>Ironer</th>
					</tr>
					@foreach($data as $row)
					<tr>
					<td>{{ $row->tagno }}</td>
					<td>{{ $row->ironer }}</td>
				</tr>
					@endforeach
				</table>


			</div>
			
		</div>

	</div>
</div>
@endsection
