@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="form-group"><a href="/dashboard/suppliers/{{$supplier->id}}/stockin" class="btn btn-default">Go Back</a></div>
<div class="card">
	<div class="card-body">
		<form method="POST" action="/dashboard/suppliers/{{$supplier->id}}/stockin">
		@csrf
		<div class="row mb-5">
			<div class="col-6">
				<div class="form-group ">
					<label>Delivery Code</label>
					<input type="text" name="code" placeholder="Code" value="DC-{{rand(1000,9999)}}" readonly class="form-control">
				</div>
				<div class="form-group ">
					<label>Amount</label>
					<input type="text" name="amount" readonly placeholder="Amount" class="form-control">
				</div>
			</div>

			<div class="col-6">
				<div class="row">
					<div class="form-group col-6">
						<label>Delivery Date</label>
						<input type="date" name="delivery_date" placeholder="Delivery Date" class="form-control">
					</div>
					<div class="form-group col-6">
						<label>Due Date</label>
						<input type="date" name="due" placeholder="Due" class="form-control">
					</div>
					<div class="form-group col-6">
						<label>Terms</label>
						<input type="text" name="term" placeholder="Terms" class="form-control">
					</div>
					<div class="form-group col-6">
						<label>Discount</label>
						<input type="text" name="discount" placeholder="Discount" class="form-control">
					</div>
				</div>
			</div>

			<div class="col-8">
					<div class="card ">
						<div class="card-header"><label>Product List</label></div>
						<div class="card-body">
						
						<div class="table-responsive">
							<table id="productlist" class="table table-bordered">
								<thead>
									<tr>
										<th>Name</th>
										<th>Original</th>
										<th>Selling</th>
										<th>Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(count($products))
										@foreach($products as $product)
										<tr>
											<td>{{$product->name}}</td>
											<td>{{$product->original}}</td>
											<td>{{$product->price}}</td>
											<td>{{$product->quantity}}</td>
											<td><button id="{{$product}}" type="button" class="select_prod btn btn-info btn-sm"><i class="fa fa-check"></i> Select</button></td>
										</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="form-group">
					
					<div class="card">
						<div class="card-header"><label>Product Details</label></div>
						<div class="card-body">
							<div class="form-group">
								<input type="text" name="name" placeholder="Name" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="original" placeholder="Original Price" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="price" placeholder="Selling Price" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="quantity" placeholder="quantity" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-success btn-block" type="button" id="AddRow"><i class="fa fa-shopping-cart"></i> Add Product</button>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		
	</div>
</div>
@endsection


@section('script')

<script type="text/javascript">
	$(document).on('click', '.select_prod', function(){
    var product = $(this).attr("id");
    product = JSON.parse(product)
    console.log(product);
    $("input[name=name]").val(product.name);
    $("input[name=original]").val(product.original);
    $("input[name=price]").val(product.price);
    $("input[name=quantity]").val(product.quantity);
  });
</script>

@endsection