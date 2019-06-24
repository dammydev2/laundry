@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<button id="printPageButton" onClick="window.print();">Print</button>

		<?php $sum = 0 ?>

		@foreach($data as $row)

		<?php $sum += $row->exp;  ?>
		@endforeach

		
		@for ($i=1; $i <= $sum; $i++) 

		<div style="border: 1px solid #000; width: 100px">
			{{ $i }} of {{$sum}}<br>
			<b>{{ $row->tag }}</b><br>
			{{ $row->collect_date }}
		</div>
			
			

			@endfor
		
		 

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
