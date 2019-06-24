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
					<td><a href="{{ url('stock') }}" class="btn btn-primary fa fa-arrow-left">Return</a></td>
				</tr>
				<tr>
					<th>Customer ID</th>
					<th>Name</th>
					<th>Tag</th>
					<th>category</th>
					<th>qty</th>
					<th>price</th>
					<th>add info</th>
					<th>extra</th>
					<th>sub total</th>
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
					<td>{{ $row->price }}</td>
					<td>{{ $row->info }}</td>
					<td>{{ $row->addamount }}</td>
					<td class="text-right">{{ $total = ($row->qty * $row->price) + $row->addamount }}</td>
					<td>{{ $row->collect_date }}</td>
				</tr>
				<?php $sum += $total ?>
				@endforeach

				<tr>
					<th colspan="8" class="text-right">Total</th>
					<th class="text-right">{{ number_format($sum, 2) }}</th>
				</tr>

				<tr>
					<td colspan="8" class="text-right">Discount</td>
					<td class="text-right">{{ number_format($row->discount, 2) }}</td>
				</tr>

				<tr>
					<td colspan="8" class="text-right">Grand Total</td>
					<td class="text-right">{{ number_format($sum - $row->discount, 2) }}</td>
				</tr>

				<tr>
					<td colspan="8" class="text-right">Deposit</td>
					<td class="text-right">{{ number_format($row->deposit, 2) }}</td>
				</tr>

				<tr>
					<td colspan="8" class="text-right">Balance</td>
					<th class="text-right">{{ number_format($row->balance, 2) }}</th>
				</tr>

				<tr>
					<td colspan="8" class="text-right">Balance Paid</td>
					<th class="text-right">{{ $row->balance_paid }}</th>
				</tr>


			</table>
		</div>

	</div>
</div>
@endsection
