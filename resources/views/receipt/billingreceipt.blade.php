@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="form-inline mb-3">
	<span class="form-group"><a href="/dashboard/billing/{{$billing->client->id}}/client" class="btn btn-default">Go Back</a></span>
	<div class="form-group ml-2"><button id="printbtn" class="btn btn-default"><i class="fa fa-print"></i> Print</button></div>	
	<div class="form-group ml-2"><a href="/dashboard/billingreport" class="btn btn-default"><i class="fa fa-book"></i> Billing Report</a></div>	
</div>
<div class="row">
	<div class="col-md-6 mx-auto">
		<div class="card">
			<div class="card-body">
			                <div class="mx-auto">
			                    <div class="table-responsive">
			                      <table id="printTable" style="margin-right: 1000px;"  border=1>
			                        <thead>
			                          <br>
			                          <tr>
			                            <td colspan="2"><p class="text-center"><img src="{{asset('adminlte3/dist/img/logo.jpg')}}" width="5%" class="img-circle elevation-1"><b> DR. S & J VETERENARY CLINIC & GROOMING CENTER </b><br>Door 2, Garces Bldg, Alijis Road,<br> Brgy Alijis, Bacolod City 6100
			                            <br>
			                            Contact No.: 09086958978
			                            <br>
			                            ************************************************************************
			                            <br><i class="text-center" style="font-size: 1.5em">Receipt</i>
			                            </p>                          
			                              
			                          </tr>
			                          <tr>
			                          
			                            <td colspan="2" class="text-right"><b>Date:</b> {{$billing->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}&nbsp; </td>
			                          </tr>

			                          <tr>
			                         
			                            <td  colspan="2" ><span class="float-right"><b>Receipt #:</b> {{$billing->rcode}}&nbsp; </span>

			                            </td>
			                          </tr>
			                        </thead>
			                    
			                        <tbody >
			                          <tr>
			                            <td colspan="2">
			                              <div class="table-responsive">

			                               @if(!$billing->products->isEmpty())
			                               	<table border="0" height="300px" width="100%" align="center">
			                               	  <thead>
			                               	  	<tr>
			                               	  		<th colspan="7" style="border-bottom:1px solid black" class="text-center"> Products</th>
			                               	  	</tr>
			                               	    <tr>
			                               	    <th class="text-center">#</th>
			                               	      <th class="text-center">Name:</th>
			                               	      <th class="text-center">Category:</th>
			                               	      <th class="text-center">Unit:</th>
			                               	      <th class="text-center">Price:</th>
			                               	      <th class="text-center">Quantity: </th>
			                               	      <th class="text-center">Amount:</th>
			                               	    </tr>
			                               	  </thead>
			                               	  <tbody>
			                               	  	@foreach($billing->products as $key => $product)
			                               	  		<tr>
			                               	  			<td>{{$key+1}}</td>
			                               	  			<td>{{$product->name}}</td>
			                               	  			<td>{{$product->category}}</td>
			                               	  			<td>{{$product->unit}}</td>
			                               	  			<td>{{$product->price}}</td>
			                               	  			<td>{{$product->quantity}}</td>
			                               	  			<td>&#8369 {{number_format($product->quantity * $product->price,2)}}</td>
			                               	  		</tr>
			                               	  	@endforeach
			                               	  </tbody>
			                               	  
			                               	  <tr >
			                               	    <td colspan="7" style="border-bottom:1px solid black"><br><br><br><br><br><br></td>
			                               	  </tr>
			                               	</table>
			                               @endif

			                               @if(!$billing->services->isEmpty())
			                               	<table border="0" height="10px" width="100%" align="center">
			                               	  <thead>
			                               	  	<tr>
			                               	  		<th colspan="7" style="border-bottom:1px solid black" class="text-center"> Services</th>
			                               	  	</tr>
			                               	    <tr>
			                               	    <th class="text-center">#</th>
			                               	      <th class="text-center">Appointment:</th>
			                               	      <th class="text-center">Amount:</th>
			                               	    </tr>
			                               	  </thead>
			                               	  <tbody>
			                               	  	@foreach($billing->services as $key => $service)
			                               	  	<tr class="text-center">
			                               	  		<td>{{$key + 1}}</td>
			                               	  		<td>{{str_limit($service->appointment,25)}}</td>
			                               	  		<td>&#8369 {{$service->amount}}</td>
			                               	  	</tr>
			                               	  	@endforeach
			                               	  </tbody> 
			                               	</table>
			                               @endif

			                                <table border="0" height="100px" width="100%" align="center">
			                                	
			                                	<tr>
			                                	  <td><br><br><br><br><br><br></td>
			                                	</tr>
			                                	<tr>
			                                	  <td  colspan="7" class="text-right"><b></b> </td>
			                                	  <td class="text-right" style="border-top:1px solid black;"" ><label>Overall Amount:</label> &#8369 {{number_format($billing->amount,2)}}</td>
			                                	</tr>
			                                </table>

			                              </div>

			                            </td>
			                          </tr>
			                        </tbody>
			                        <tfoot>
			                          <tr>
			                            <td colspan="2"><p class="text-center">
			                              ************************************************************************
			                              <br>
			                              <i >Thank you for choosing us!<br> DR. S & J VETERENARY CLINIC & GROOMING CENTER<br>
			www.DRSANDJVETERENARYCLINIC.shop</i></p></td>
	                      </tr>
	                    </tfoot>
	                  </table>
	                </div>
	            </div>
	          </div>
		</div>
	</div>

</div>
@endsection
@section('script')
<script type="text/javascript" src="{{asset('adminlte3/dist/js/printThis.js')}}"></script>
<script type="text/javascript">
  $('#printbtn').click(function(){
    $('#printTable').printThis();
  });
</script>
@endsection