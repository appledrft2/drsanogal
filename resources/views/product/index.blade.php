@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/product" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/product/search">
						@csrf
						<div class="input-group ">
						  <input type="text" class="form-control form-control-sm" name="data" placeholder="Search by name" aria-label="Recipient's username" aria-describedby="basic-addon2">
						  <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
						  </div>
						</div>
					</form>
				</div>
				
			</div>
			<div class="pull-left">
				<a href="/dashboard/product/create" class="btn btn-default btn-lg"><i class="fa fa-plus-circle"></i></a>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Supplier</th>
						<th>Name</th>
						<th>Category</th>
						<th>Unit</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Sub Total</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($products))
						@foreach($products as $product)
							<tr>
								<td onclick="window.location = '/dashboard/product/{{$product->id}}/edit';"><a href="/dashboard/supplier/{{$product->supplier->id}}/edit">{{$product->supplier->name}}</a></td>
								<td onclick="window.location = '/dashboard/product/{{$product->id}}/edit';">{{$product->name}}</td>
								<td onclick="window.location = '/dashboard/product/{{$product->id}}/edit';">{{$product->category}}</td>
								<td onclick="window.location = '/dashboard/product/{{$product->id}}/edit';">{{$product->unit}}</td>
								<td onclick="window.location = '/dashboard/product/{{$product->id}}/edit';" class="text-right">&#8369; {{$product->price}}</td>
								<td onclick="window.location = '/dashboard/product/{{$product->id}}/edit';">{{$product->quantity}}</td>
								<td onclick="window.location = '/dashboard/product/{{$product->id}}/edit';" class="text-right">&#8369; {{number_format($product->quantity * $product->price,2)}}</td>
								
								<td width="15%">
									<div class="form-inline">		
										<a href="/dashboard/product/{{$product->id}}/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
										<form  method="POST" action="/dashboard/product/{{$product->id}}">
											@method('delete')
											@csrf
											<button class="btn btn-danger btn-sm mt-3 btn-submit"><i class="fa fa-trash"></i></button>
										</form>
									</div>
								</td>
							</tr>
						@endforeach
						<tr>
							<td colspan="5"></td>
							<td class="text-center"><label>Total</label></td>
							<td class="text-right"><?php $sum=0; ?>
								@foreach($products as $product)
									<?php $sum = $sum + $product->quantity * $product->price ?>
								@endforeach
								&#8369; <?php echo number_format($sum,2); ?>
							</td>
							<td></td>
						</tr>
						<tbody></tbody>
					@else
					<tr><td colspan="8" class="text-center">No Data</td></tr>
					@endif
				</tbody>
			</table>
			<div class="float-right mt-1">{{ $products->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection