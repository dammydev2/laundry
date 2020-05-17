@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">

		<button id="printPageButton" onClick="window.print();">Print</button>

		<?php $sum = 0 ?>

		@foreach($data as $row)
		<?php $sum += $row->exp * $row->qty;  ?>
		@endforeach

		@php

		$dt = strtotime($row->created_at);

		@endphp
		
			<?php
		 $whole_elements = $sum;

$third = ceil($whole_elements / 2);
$group1 =$third;
$group2 = $whole_elements - 1*$third;
//echo 'one: ' . $group1 . '<br/>two: ' . $group2; 
?>

<table>
    <tr>
        <td>
            @for ($i=1; $i <= $group1; $i++) 

		<div style=" width: 120px; font-size: 12px;">
			<span>{{ $i }} of {{$sum}}</span> <span style="float: right;">{{ date('d-m-Y', $dt) }}</span><br>
			<center><b>{{ $row->tag }}</b><br></center>
			<span class="text-center">{{ $row->collect_date }}</span>
		</div>
		<p>&nbsp;</p>
			@endfor
        </td>
        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td>
            @for ($i=$group1 + 1; $i <= $group2 + $group1; $i++) 

		<div style=" width: 120px; font-size: 12px;">
			<span>{{ $i }} of {{$sum}}</span> <span style="float: right;">{{ date('d-m-Y', $dt) }}</span><br>
			<center><b>{{ $row->tag }}</b><br></center>
			<span class="text-center">{{ $row->collect_date }}</span>
		</div>
		<p>&nbsp;</p>
			@endfor
        
        <?php
        if ($group2 % 2 === 0) {
   echo "<p>&nbsp;</p>";
   echo "<p>&nbsp</p>";
   echo "<p>&nbsp</p>";
} else {
   echo "<p>&nbsp;</p>";
   echo "<p>&nbsp</p>";
   echo "<p>&nbsp</p>";
}
        ?>
        </td>
    </tr>
</table>
		
	
		
	

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
