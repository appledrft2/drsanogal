@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="form-inline mb-2">
	<div class="form-group ml-2"><a href="/dashboard/stockout" class="btn btn-default"><i class="fa fa-shopping-cart"></i> POS</a></div>
	<div class="form-group ml-2"><button id="printbtn" class="btn btn-default"><i class="fa fa-print"></i> Print</button></div>
	 @if(Auth::user()->role == 'doctor')
	<div class="form-group ml-2"><a href="/dashboard/report" class="btn btn-default"><i class="fa fa-book"></i> Report</a></div>
	@endif
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
			                            <td colspan="2"><p class="text-center"><img src="{{asset('adminlte3/dist/img/logo.jpg')}}" width="5%" class="img-circle elevation-1"><b> DR. S & J VETERINARY CLINIC & GROOMING CENTER </b><br>Door 2, Garces Bldg, Alijis Road,<br> Brgy Alijis, Bacolod City 6100
			                            <br>
			                            Contact No.: 09086958978
			                            <br>
			                            ************************************************************************
			                            <br><i class="text-center" style="font-size: 1.5em">Receipt</i>
			                            </p>                          
			                              
			                          </tr>
			                          <tr>
			                          
			                            <td colspan="2" class="text-right"><b>Date:</b> {{$receipt->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}&nbsp; </td>
			                          </tr>

			                          <tr>
			                         
			                            <td  colspan="2" ><span class="float-right"><b>Receipt #:</b> {{$receipt->rcode}}&nbsp; </span>

			                            </td>
			                          </tr>
			                        </thead>
			                        <tbody >
			                          <tr>
			                            <td colspan="2">
			                              <div class="table-responsive">
			                                <table border="0" height="300px" width="100%" align="center">
			                                  <thead>
			                                    <tr>
			                                    <th class="text-center">#</th>
			                                      <th class="text-center">Name:</th>
			                                      <th class="text-center">Category:</th>
			                                      <th class="text-center">Unit:</th>
			                                      <th class="text-center">Price:</th>
			                                      <th class="text-center">Quantity: </th>
			                                      <th class="text-center">Total Price:</th>
			                                    </tr>
			                                  </thead>
			                                  <tbody>
			                                  	<?php $i=1; ?>
			                             		@foreach($receipt->stockoutdetails as $details)
			                             			<tr class="text-center">
			                             				<td>{{$i++}}</td>
			                             				<td>{{$details->name}}</td>
			                             				<td>{{$details->category}}</td>
			                             				<td>{{$details->unit}}</td>
			                             				<td>&#8369 {{ number_format($details->price,2) }}</td>
			                             				<td>{{$details->quantity}}</td>
			                             				<td>&#8369 {{number_format($details->amount,2)}}</td>
			                             			</tr>
			                             		@endforeach
			                                  </tbody>
			                                  
			                                  <tr>
			                                    <td><br><br><br><br><br><br></td>
			                                  </tr>
			                                  <tr>
			                                    <td colspan="6" class="text-right"><b>Overall Amount:</b> </td>
			                                    <td class="text-center">&#8369 {{number_format($receipt->amount,2)}}</td>
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
			                              <i >Thank you for choosing us!<br> DR. S & J VETERINARY CLINIC & GROOMING CENTER<br>
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