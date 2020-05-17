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

				<a href="" class="btn btn-danger">Reset</a>
				
				<form method="post" action="addpayment">

					@php 
					$amount = 0;
					$extra = 0;
					$foldamount = 0;

					foreach($data as $row)
					{
						$amount += $row['qty'] * $row['price'];
						$extra = $row['addamount'];

						if($row->fold == 'Fold'){
						
						$addfold = 100 * $row->qty;
						
						$foldamount += $addfold;
						
					}

				}
				

				$vat = ($amount + $extra + $foldamount ) * 0.05;
				$total = $amount + $extra + $vat + $foldamount;
				@endphp

				<table class="table">
					<tr>
						<td>Net Price</td>
						<td class="text-right">{{ number_format($amount, 2) }}</td>
					</tr>
					<tr>
						<td>Addition Price</td>
						<td class="text-right">{{ number_format($extra + $foldamount, 2) }}</td>
					</tr>
					<tr>
						<td>VAT</td>
						<td class="text-right">{{ number_format($vat, 2) }}</td>
					</tr>
					<tr>
						<th>Grand Total</th>
						<th class="text-right"><b>&#8358; <input readonly="" id="dtotal" type="" class="dtotal" name="dtotal" value="{{ $total }}"></b></th>
						
					</tr>
				</table>

				{{ csrf_field() }}

				<div class="form-group">
					<label>Collection type</label>
					<select name="express" id="express" class="form-control">
						<option value="1">Normal</option>
						<option value="2">Express</option>
					</select>
					<div id="debug"></div>
				</div>

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
					<label>Hanger (in dozen)</label>
					<input type="number" name="hanger" class="form-control" onkeyup="gethanger()" id="hanger">
				</div>

				<div class="form-group">
					<label>Grand Total</label>
					<input type="text" name="total" class="form-control text1"  readonly="" id="Text1">
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

					<?php
					$Date = date('Y-m-d');
					$date = date('Y-m-d', strtotime($Date. ' + 2 days'));
					?>

					<div class="form-group">
						<label>Collection Date</label>
						<input type="date" name="collect" value="{{ $date }}" class="form-control">
					</div>

					<div class="form-group">
						<label>Payment Type</label>
						<select class="form-control" name="type">
							<option>Cash depoit</option>
							<option>Bank Transfer</option>
							<option>POS</option>
						</select>
					</div>					

					<input type="submit" name="submit" value="continue" class="btn btn-primary">

				</form>

			</div>
			
		</div>

	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
	$(function() {
		dtotal = '{{ $total }}'
  $("#express").on("change", function() {
  	exp = $("#express").val();
  	if(exp === '2'){
  		newTotal = dtotal * 2;
  	}
  	if(exp === '1'){
  		newTotal = dtotal;
  	}
  		
  		$('.dtotal').val(newTotal);
  		$('.text1').val(newTotal);
  	console.log(newTotal);
  }).trigger("change");
});
</script>

<script type="text/javascript">
	//document.getElementById("Text1").value = document.getElementById("dtotal").value;

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
	
	function gethanger()
	{
		var first_number = parseInt(document.getElementById("Text1").value);
		var hanger = parseInt(document.getElementById("hanger").value);
		var hang = first_number - (1 * hanger * 80);
		var sethang = parseFloat(1*hang);
		$('#Text1').val(sethang);
		//document.getElementById("Text1").value = sethang;
	}
</script>
@endsection
