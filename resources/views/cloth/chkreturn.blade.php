@extends('layouts.app')

@section('content')
<div class="container">
	<!--<div class="row">-->
		
		@if(Session::has('success'))
		<div class="alert alert-success">{{ Session::get('success') }}</div>
		@endif

		@if(Session::has('error'))
		<div class="alert alert-danger">{{ Session::get('error') }}</div>
		@endif

		

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

				<div style=" width: 250px; font-size: 12px">
					<center>
						<h5 style="margin-top: -1px;"><b>Magson Dry-cleaners</b></h5>
						<P style="margin-top: -10px;">
						 89 Adeniyi Jones, Ikeja, Lagos. 08037870671<br>
							<!--<i class="fa fa-phone"><b> (+234) 803 787 0671</b></i>-->
							
						@foreach($data as $row)
						@endforeach
						Customer id: {{ $row->cus_id }}
					
						</p>
					</center>

					<!--<center style="margin-top: -10px;">
						@foreach($data as $row)
						@endforeach
						Customer id: {{ $row->cus_id }}
					</center>-->

					<div class="container" style="margin-top:-10px;">
						Date: {{ date('d/m/Y') }}
						<span  style="margin-left: 20px;">Tag no:</span><b><i> {{ Session::get('tag') }} </i></b>

					</div>

					<hr>
					<table style="margin-top: -40px;">
						@foreach($data2 as $row)
						<tr>
							<td><b>{{ $row->name }}</b></td>
						</tr>
						@endforeach
					</table>

					<table style="width: 100%; font-size:11px;">
						<tr>
							<th style="padding: 5px;"></th>
							<th colspan='3' style="padding: 5px;">Item</th>
							<th style="width: 40px;" style="padding: 5px;">Price</th>
							<!--<th>Amount</th>-->
							<!--<th>Other Info</th>-->
							<th>Sub Total</th>
						</tr>

						@php
						$sum = 0;
						$pcs = 0;
						$foldamount = 0;
						@endphp

						@foreach($data as $row)
						<?php 
						if($row->fold == 'Fold'){
						
						$addfold = 100 * $row->qty;
						
						$foldamount += $addfold;
					}
						 ?>
						<tr  style="vertical-align:top">
							<td class="text-bold">{{ $row->qty }} </td>
							<td colspan='3'> {{ $row->category }}
							
								@foreach($data3 as $gt)

								@if($row->category == $gt->category)
								{{ '['. $gt->qty.']' .$gt->color }}

								@endif

								@foreach($data4 as $gt2)

								@if($gt2->category == $row->category.' ('.$gt->color.')' )

								({{ $gt2->qty.' '.$gt2->service }} )

								@endif

								@endforeach

								@endforeach

								{{ "... (".($row->fold).")" }} {{ $row->servicetype }} 
							
							<p>&nbsp;</p>
							</td>
							<td> {{ $row->price }} </td>
							<!--<td> {{ $sub = $row->price * $row->qty * $row->express }} </td>-->
							<!--<td> 
							</td>-->
								<td class="text-right">{{ number_format($total = $sub, 2) }}</td>

								@php
								$sum += $total;
								$pcs += $row->exp * $row->qty; 
								@endphp
							</tr>
							@endforeach

							<tr>
								<th colspan='3'><b>{{ $row->totalCloth }}</b>  Piece(s) of cloth</th>
								<th colspan="2" class="text-right">Sub Total &nbsp;</th>
								<td class="text-right"><b>&#8358; {{ number_format($sum, 2) }}</b></td>
							</tr>

							<?php
							$others = $foldamount + $row->addamount;
							?>
							<!--<tr>
								<td colspan="3" rowspan="3"></td>
								<th colspan="2" class="text-right">Other Services &nbsp;</th>
								<td class="text-right"> {{ number_format($others, 2) }}</td>
							</tr>-->

							<tr>
								<!--<th class="text-right"> Total</th>
								<td class="text-right">&#8358; {{ number_format($total = $sum + $others, 2) }}</td>-->
							</tr>
							
							<tr>
								<td colspan="3" rowspan="3"></td>
								<th colspan="2" class="text-right">VAT &nbsp;</th>
								<td class="text-right">{{ number_format($vat = $total * 0.05, 2) }}</td>
							</tr>

							<tr>
								<!--<th colspan="5" class="text-right">Net Total</th>
								<td class="text-right"><b>&#8358; {{ number_format($net = $total + $vat, 2) }}</b></td>-->
							</tr>

							<tr>
								<td colspan="2" class="text-right">Discount &nbsp;</td>
								<td class="text-right">{{ number_format(($discount = $net * ($row->discount / 100)), 2) }}</td>
							</tr>

							<tr>
								<td colspan="5" class="text-right">Gross Total &nbsp;</td>
								<td class="text-right">{{ number_format($gross = $net - ($discount + ($row->hanger * 80)), 2) }}</td>
							</tr>

							<tr>
								<td colspan="5" class="text-right">Deposit &nbsp;</td>
								<td class="text-right">{{ number_format($row->deposit, 2) }}</td>
							</tr>

							<tr>
								<td colspan="5" class="text-right">Balance &nbsp;</td>
								<td class="text-right"><b><i>&#8358;{{ number_format($gross - $row->deposit, 2) }}</i></b></td>
							</tr>

						<!--<tr>
							<td colspan="5" class="text-right">Balance</td>
							<td class="text-right"><b><i>&#8358; {{ number_format($row->balance, 2) }}</i></b></td>
						</tr>-->
					</table>

					<p>Collection Date: <b>{{ $row->collect_date }} by 6:00pm</b></p>
					
					<p><b>{{ $row->hanger }}</b> Hanger</p>

					<i style="font-size:10.5px;">Satisfied with our services? tell others, if not, tell us</i>

					<p style="font-size:11px;">Thanks for your patronage, we look forward to your call again</p>
					</div>

	
</div>

<div class="col-sm-3">
	@if($getTag->collect == 0)
	<a href="{{ url('collected/'.$row->tag) }}" class="btn btn-primary">Mark as collected<i class="fa fa-check-circle" aria-hidden="true" style="font-size: 50px;"></i></a>
	@else
	<button class="btn btn-success">Already collected</button>
	@endif
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
