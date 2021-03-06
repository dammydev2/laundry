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

		@php

		$date = Session::get('start');
		$date2 = Session::get('2nd');

		$createDate = new DateTime($date);
		$createDate2 = new DateTime($date2);

		$strip = $createDate->format('Y-m-d');
		$strip2 = $createDate2->format('Y-m-d');
		//var_dump($strip); // string(10) "2012-09-09"

		@endphp

		<div class="col-sm-8" >
			<button id="printPageButton" onClick="window.print();">Print</button>

			<table class="table table-bordered" border="1" style="overflow-y: scroll;">
				<tr>
					<th colspan="7"><center>All income generated from: {{ $strip }} to {{ $strip2 }}</center></th>
				</tr>
				<tr>
					<th>Tag</th>
					<th>Name</th>
					<th>amount paid</th>
					<th>balance</th>
					<th>Payment method</th>
					<th>Payment type</th>
				</tr>
				
				<?php $sum = 0; $inc = ''; ?>
				@foreach($data as $row)
				<tr>
					<td>{{ $row->cus_id }}</td>
					<td>{{ $row->name }}</td>
					<td class="text-right">{{ $row->amount }}</td>
					<td>{{ $row->balance }}</td>
					<td>{{ $row->method }}</td>
					<td>
						@if($row->type == 'Deposit')
						 initial
						@endif
						{{ $row->type }}</td>
				</tr>
				<?php $sum += $row->amount ?>
				@endforeach

				<tr>
					<td colspan="2" class="text-right">Grand Total</td>
					<th class="text-right">{{ number_format($sum, 2) }}</th>
				</tr>

			</table>
		</div>

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
