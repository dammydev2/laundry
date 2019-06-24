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
			<div class="panel-heading">Payment</div>
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
				
				<form method="post" action="addpayment">

					@php 
					$amount = 0;
					$extra = 0;
					

					foreach($data as $row)
					{
						$amount += $row['qty'] * $row['price'];
						$extra = $row['addamount'];
					}
					$vat = ($amount + $extra) * 0.05;
					$total = $amount + $extra + $vat;
					@endphp

					<table class="table">
						<tr>
							<td>Net Price</td>
							<td class="text-right">{{ number_format($amount, 2) }}</td>
						</tr>
						<tr>
							<td>Addition Price</td>
							<td class="text-right">{{ number_format($extra, 2) }}</td>
						</tr>
						<tr>
							<td>VAT</td>
							<td class="text-right">{{ number_format($vat, 2) }}</td>
						</tr>
						<tr>
							<th>Grand Total</th>
							<th class="text-right"><b>&#8358; {{ number_format($total, 2) }}</b></th>
						</tr>
					</table>
					
					{{ csrf_field() }}

					<div class="form-group">
						<label>Discount</label>
						<select class="form-control" onchange="vat()" id="Text3" name="discount">
							<?php
							for ($i=0; $i <= 100; $i++) { 
								
								echo "<option value=".$i.">".$i."</option>";
								
							# code...
							}
							?>
						</select>
					</div>

					<div class="form-group">
						<label>Grand Total</label>
						<input type="text" name="total" class="form-control"  readonly="" id="Text1">
					</div>

					<div class="form-group">
						<label>Amount Deposit</label>
						<input type="number" name="deposit" class="form-control" onkeyup="add_number()" id="Text2">
					</div>

					


					<!--<div class="form-group">
						<label>Discount</label>
						<input type="number" value="0" name="discount" class="form-control" onkeyup="add_number()" id="Text3">
					</div>-->

					<div class="form-group">
						<label>Balance</label>
						<input type="text" name="balance" class="form-control" readonly="" id="txtresult">
					</div>

					<div class="form-group">
						<label>Collection Date</label>
						<input type="date" name="collect" class="form-control">
					</div>

					<input type="submit" name="submit" value="continue" class="btn btn-primary">

				</form>

			</div>
			
		</div>

	</div>
</div>

<script type="text/javascript">
	document.getElementById("Text1").value = <?php echo $total ?>;

	function add_number() {

		var first_number = parseInt(document.getElementById("Text1").value);
		var second_number = parseInt(document.getElementById("Text2").value);
		var result = first_number - (second_number);

		document.getElementById("txtresult").value = result;
	}

	function vat() {

		var first_number = parseInt(document.getElementById("Text1").value);
		var vat = parseInt(document.getElementById("Text3").value);
		var num =  (first_number * (vat/100));
		var result = first_number - num;
		document.getElementById("Text1").value = result;
	}
</script>
@endsection
