@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="card">
		<div class="card-body">
			<div class="card card-sm">
				<div class="card-header"><p class="lead float-left">Supplier Information</p> <span class="float-right"><a href="/dashboard/suppliers" class="btn btn-default">Go Back</a></span></div>
				<div class="card-body">
					<div class="row">
						<div class="col-7">
							<div class="">
								<label style="font-size:1em" class="lead">Name:</label>
								<span style="font-size:1em" class="lead">{{$supplier->name}}</span>
							</div>
							
							<div class="">
								<label style="font-size:1em" class="lead">Contact:</label>
								<span style="font-size:1em" class="lead">{{$supplier->contact}}</span>
							</div>
							<div class="">
								<span class="form-inline">
									<label style="font-size:1em" class="lead">Address:</label>
									<span style="font-size:1em" class="lead mt-3 ml-2">{!!$supplier->address!!}</span>	
								</span>
							</div>
							
						</div>
						<div class="col-5">
							<div class="">
								
								<div class="form-group">
									<div style="font-size:5.5em;margin-left:200px">
										<i class="fa fa-truck"></i>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		
<!-- 		
			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/suppliers/{{$supplier->id}}/stockin" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/suppliers/{{$supplier->id}}/stockin/search">
						@csrf
						<div class="input-group ">
						  <input type="text" class="form-control form-control-sm" name="data" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
						  <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
						  </div>
						</div>
					</form>
				</div>
				
			</div> -->
			<div class="pull-left mb-3">
				<a href="/dashboard/suppliers/{{$supplier->id}}/stockin/create" class="btn btn-default"><i class="fa fa-plus-circle"></i> New Delivery</a>
			</div>	
			<div class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Delivery Date</th>
						<th>Term</th>
						<th>Due</th>
						<th>Discount</th>
						<th>Amount</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($stockins))
					<?php $i=1; ?>
						@foreach($stockins as $stockin)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$stockin->code}}</td>
								<td>{{ date('M d, Y', strtotime($stockin->delivery_date))}}</td>
								<td>{{$stockin->term}}</td>
								<td>{{ date('M d, Y', strtotime($stockin->due))}}</td>
								<td>
									@if($stockin->discount == 0)
									No Discount
									@else
									{{$stockin->discount * 100}} %
									@endif
								</td>
						
								<td class="text-right">&#8369; {{number_format($stockin->amount,2)}}</td>
								<td width="15%">
									<div class="form-inline">
										
										
										<form method="POST" action="/dashboard/suppliers/{{$supplier->id}}/stockin/{{$stockin->id}}">
											@method('delete')
											@csrf
											<input type="hidden" name="sid" value="{{$stockin->id}}">
											<button class="btn btn-danger btn-sm mt-3 btn-submit"><i class="fa fa-trash"></i> &nbsp; Delete Delivery</button>
										</form>
									</div>
								</td>
							</tr>
						@endforeach
					@else
			<!-- 		<tr><td colspan="10" class="text-center">No Data</td></tr> -->
					@endif
				</tbody>
			</table>
			</div>

		</div>
	</div>
@endsection