@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<p>&nbsp</p>


		<?php $sum = 0 ?>

		@foreach($data as $row)

		<?php $sum += $row->exp;  ?>
		@endforeach

		<form method="post" action="{{ url('/inputironer') }}" class="col-sm-6">

			{{ csrf_field() }}

			<input type="hidden" name="tag" value="{{ $row->tag }}">

			@for ($i=1; $i <= $sum; $i++) 

			<div class="form-group col-sm-6">
				<input type="text" class="form-control" name="tagno[]" value="{{ $i.' of '. $sum }}" readonly="">
			</div>

			<div class="form-group col-sm-6">
				<input type="text" name="ironer[]" class="form-control" placeholder="ironer name">
			</div>
			
			

			@endfor

			<input type="submit" name="" class="btn btn-primary">

		</form>


	</div>
</div>

<style type="text/css">
	@media print {
		#printPageButton {
			display: none;
		}
	}
</style>
@endsection
