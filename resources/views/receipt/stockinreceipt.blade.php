@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="form-inline mb-3">
	<span class="form-group"><button onclick="history.back()" class="btn btn-default">Go Back</button></span>
	<div class="form-group ml-2"><button id="printbtn" class="btn btn-default"><i class="fa fa-print"></i> Print</button></div>
	
</div>
<div class="row">
	<div class="col-md-12 mx-auto">
		<div class="card">
			<div class="card-body">
			                <div class="mx-auto">
			                    <div class="table-responsive">
			                      <table id="printTable" width="100%">
			                        <thead>
			                          <br>
			                        	<tr>
			                        		<td><b>Supplier:</b> {{$stockin->supplier->name}}</td>
			                        		<td class="text-right"><b>Delivery Date:</b> {{$stockin->delivery_date}} &nbsp; <b>Due Date:</b> {{$stockin->due}}</td>
			                        	</tr>
			                        	<tr>
			                        		<td><b>Mode of Payment:</b> {{$stockin->mop}}</td>
			                        	</tr>
			                        	@if($stockin->mop == 'Partial')
			                        	<tr>
			                        		<td><b>Partial:</b> {{$stockin->partial}}</td>
			                        	</tr>
			                        	@endif
			                        	<tr>
			                        		<td><b>Discount:</b> 
			                        			@if($stockin->discount == 0)
			                        			No Discount
			                        			@else
			                        			{{$stockin->discount * 100}} %
			                        			@endif
			                        		</td>
			                        	</tr>

			                        	<tr>
			                        		<td><b>Status:</b> 
			                        			@if($stockin->mop == 'Cash')
			                        			Paid
			                        			@else
			                        			{{$stockin->status}} 
			                        			@endif
			                        		</td>
			                        	</tr>

			                          <tr>
			                          <td class="float-left"><b>Receipt #:</b> {{$stockin->code}}&nbsp; </td>
			                            <td class="text-right"><b>Date: </b>{{$stockin->created_at->isoFormat('MMMM Do YYYY')}}&nbsp;  </td>
			                          </tr>

			                    
			                        </thead>
			                    
			                        <tbody >
			                          <tr>
			                            <td colspan="2">
			                              <div class="table-responsive">

			                               
			                               	<table border="0" height="100px" width="100%" align="center">
			                               	  <thead>
			                               	  	<tr>
			                               	  		<th colspan="7" style="border-bottom:1px solid black" class="text-center"> Products</th>
			                               	  	</tr>
			                               	    <tr>
			                               	    <th class="text-center">#</th>
			                               	      <th class="text-center">Name:</th>
			                               	      <th class="text-center">Original:</th>
			       
			                               	      <th class="text-center">Price:</th>
			                               	      <th class="text-center">Quantity: </th>
			                               	     
			                               	    </tr>
			                               	  </thead>
			                               	  <tbody>
			                               	  	@foreach($details as $key => $dt)
			                               	  		<tr>
			                               	  			<td class="text-center">{{$key + 1}}</td>
			                               	  			<td class="text-center">{{$dt->name}}</td>
			                               	  			<td class="text-center">{{$dt->original}}</td>
			                               	  			<td class="text-center">{{$dt->price}}</td>
			                               	  			<td class="text-center">{{$dt->quantity}}</td>
			                               	  		</tr>
			                               	  	@endforeach
			                               	  </tbody>
			                               	  
			                               	 
			                               	</table>
			                          

			                              

			                                <table border="0" height="100px" width="100%" align="center">
			                                	
			                                	<tr>
			                                	  <td><br><br><br><br><br><br></td>
			                                	</tr>
			                                	<tr>
			                                	  <td  colspan="7" class="text-right"><b></b> </td>
			                                	  <td class="text-right" style="border-top:1px solid black;" ><label>Overall Amount:</label> &#8369 {{number_format($stockin->amount,2)}}</td>
			                                	</tr>
			                                </table>

			                              </div>

			                            </td>
			                          </tr>
			                        </tbody>
			                       
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