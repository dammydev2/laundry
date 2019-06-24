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

		<div class="" >
			<button id="printPageButton" onClick="window.print();">Print</button>

			<table class="table table-bordered" border="1" style="overflow-y: scroll;">
				<tr>
					<th colspan="7"><center>All returned clothes from: {{ $strip }} to {{ $strip2 }}</center></th>
				</tr>
				<tr>
					<th>Customer ID</th>
					<th>Name</th>
					<th>Tag</th>
					<th>category</th>
					<th>qty</th>
					<th>add info</th>
					<th>extra</th>
					<th>collection date</th>
				</tr>
				
				<?php $sum = 0; ?>
				@foreach($data as $row)
				<tr>
					<td>{{ $row->cus_id }}</td>
					<td>{{ $row->name }}</td>
					<td>{{ $row->tag }}</td>
					<td>{{ $row->category }}</td>
					<td>{{ $row->qty }}</td>
					<td>{{ $row->info }}</td>
					<td>{{ $row->addamount }}</td>
					<td>{{ $row->collect_date }}</td>
				</tr>
				<?php $sum += $row->qty ?>
				@endforeach

				<tr>
					<td colspan="4" class="text-right">Total Clothes</td>
					<th class="text-right">{{ $sum }}</th>
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
