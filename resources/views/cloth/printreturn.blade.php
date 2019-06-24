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

		<div class="panel panel-primary">
			<div class="panel-heading" id="printPageButton">Payment</div>
			<div class="panel-body">

				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				
				<button id="printPageButton" onClick="window.print();">Print</button>

				<div style="border: 1px solid #000" style="width: 900px">
					<center>
						<h3>THE LAUNDRY</h3>
						<P>CUSTOMER RECEIPT</P>
						<p>Address: 89 Adeniyi Jones, Ikeja, Lagos<br>
							<i class="fa fa-phone"> (+234) 803 787 0671</i>
						</p>
					</center>

					<div class="container">
						Date: {{ date('d/m/Y') }}
						<span  style="margin-left: 300px;">Tag no:</span><b><i> {{ Session::get('tag') }} </i></b>

					</div>

					<p>&nbsp;</p>

					<table class="table">
						@foreach($data2 as $row)
						<tr>
							<td>Customer Name: <b>{{ $row->name }}</b></td>
							<td>Phone: <b>{{ $row->phone }}</b></td>
						</tr>
						<tr>
							<td colspan="2">Address: {{ $row->address }}</td>
						</tr>
						@endforeach
					</table>

					<table class="table table-bordered">
						<tr>
							<th>Qty</th>
							<th>Category</th>
							<th>Price</th>
							<th>Amount</th>
							<th>Other Info</th>
							<th>Sub Total</th>
						</tr>

						@php
						$sum = 0;
						@endphp

						@foreach($data as $row)
						<tr>
							<td> {{ $row->qty }} </td>
							<td> {{ $row->category }} </td>
							<td> {{ $row->price }} </td>
							<td> {{ $sub = $row->price * $row->qty }} </td>
							<td> {{ $row->info }} </td>
							<td class="text-right">{{ number_format($total = $sub, 2) }}</td>

							@php
							$sum += $total;
							@endphp
						</tr>
						@endforeach

						<tr>
							<th colspan="5" class="text-right">Sub Total</th>
							<td class="text-right"><b>&#8358; {{ number_format($sum, 2) }}</b></td>
						</tr>

						<tr>
							<th colspan="5" class="text-right">Other Services</th>
							<td class="text-right">&#8358; {{ number_format($row->addamount, 2) }}</td>
						</tr>

						<tr>
							<th colspan="5" class="text-right"> Total</th>
							<td class="text-right">&#8358; {{ number_format($total = $sum + $row->addamount, 2) }}</td>
						</tr>

						<tr>
							<th colspan="5" class="text-right">VAT</th>
							<td class="text-right">&#8358; {{ number_format($vat = $total * 0.05, 2) }}</td>
						</tr>

						<tr>
							<th colspan="5" class="text-right">Net Total</th>
							<td class="text-right"><b>&#8358; {{ number_format($net = $total + $vat, 2) }}</b></td>
						</tr>

						<tr>
							<td colspan="5" class="text-right">Discount</td>
							<td class="text-right">{{ number_format(($discount = $net * ($row->discount / 100)), 2) }}</td>
						</tr>

						<tr>
							<td colspan="5" class="text-right">Gross Total</td>
							<td class="text-right">{{ number_format($gross = $net - $discount, 2) }}</td>
						</tr>

						<tr>
							<td colspan="6" class="text-right">Received</td>
						</tr>

						<!--<tr>
							<td colspan="5" class="text-right">Balance</td>
							<td class="text-right"><b><i>&#8358; {{ number_format($row->balance, 2) }}</i></b></td>
						</tr>-->
					</table>

					<p>Please kindly note that your clothes will be ready on: <b>{{ $row->collect_date }} by 6:00pm</b></p>

					<i>Satisfied with our services? tell others ...if not, tell us</i>

					<p>Thanks for your patronage, we look forward to your call again</p>

				</div>
			</div>
			
		</div>

	</div>
</div>

<script type="text/javascript">
	function add_number() {

		var first_number = parseInt(document.getElementById("Text1").value);
		var second_number = parseInt(document.getElementById("Text2").value);
		var result = first_number - second_number;

		document.getElementById("txtresult").value = result;
	}
</script>

<style type="text/css">
	@media print {
  #printPageButton {
    display: none;
  }
}
</style>
@endsection
