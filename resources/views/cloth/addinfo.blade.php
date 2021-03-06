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

    <div class="col-sm-8 panel panel-primary">
      <div class="panel-heading">Add additional serveces</div>
      <div class="panel-body">

        <button id="Add" class="btn btn-success">Click to add</button> <button id="Remove" class="btn btn-danger">Click to remove</button> 
        <p>&nbsp;</p>

        <form method="post" action="aditionalservice"> 

          {{ csrf_field() }}

          <div id="textboxDiv"></div> 

          <input type="submit" class="btn btn-primary" name="">
          <a href="{{ url('/payment') }}" class="btn btn-danger">No additional Service</a>

        </form>
      </div>
    </div>

  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>  
  $(document).ready(function() {  
    $("#Add").on("click", function() {  
      $("#textboxDiv").append("<div class='row'><div class='form-group col-sm-4'><select class='form-control' name='category[]'>@foreach($data2 as $row) <option>{{ $row->category }} ({{ $row->color }})</option>@endforeach</select></div><div class='form-group col-sm-4'><select class='form-control' name='service[]'>@foreach($data as $row) <option>{{ $row->service }}</option>@endforeach</select></div> <div class='form-group col-sm-4'><input type='text' name='qty[]' required class='form-control' placeholder='Quantity'/></div></div>");  
    });  
    $("#Remove").on("click", function() {  
      $("#textboxDiv").children().last().remove();  
    });  
  });  
</script> 
@endsection
