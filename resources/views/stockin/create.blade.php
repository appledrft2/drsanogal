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
					<label>Supploer </label>
					<input type="text" name="supplier" placeholder="supplier" value="{{$supplier->name}}" readonly class="form-control">
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
								<input type="hidden" name="prod_id" placeholder="id" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_name" placeholder="Name" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_original" placeholder="Original Price" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_price" placeholder="Selling Price" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_quantity" placeholder="quantity" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-success btn-block" type="button" id="addRow"><i class="fa fa-shopping-cart"></i> Add Product</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12">
				<div class="card">
					<div class="card-header"><label>Product Table</label></div>
					<div class="card-body">
						<table id="productlist2" class="table table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Original</th>
									<th>Selling</th>
									<th>Quantity</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="row">
								
							</tbody>

						</table>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="card">
					
					<div class="card-body ">
						<div class="float-right">
							<button class="btn btn-default"><i class="fa fa-truck"></i> Process Delivery</button>
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

    $("input[name=prod_id]").val(product.id);
    $("input[name=prod_name]").val(product.name);
    $("input[name=prod_original]").val(product.original);
    $("input[name=prod_price]").val(product.price);
    $("input[name=prod_quantity]").val(product.quantity);
  });
</script>

<script type="text/javascript">
	var i = 0;

	$('#addRow').click(function(e){
		e.preventDefault();
		$("#productlist2").DataTable().destroy();
		var id = $("input[name=prod_id]").val();
		var name = $("input[name=prod_name]").val();
		var original = $("input[name=prod_original]").val();
		var price = $("input[name=prod_price]").val();
		var quantity = $("input[name=prod_quantity]").val();

		if(id == ''){
			$("#productlist2").DataTable();
			return alert('No Product');
		}

		i++;
var row = '<tr id="row'+i+'">'+
			'<td>'+
				'<div class="form-group mr-2">'+
					'<input type="hidden" class="form-control" name="id[]" value="'+id+'">'+
					'<input type="text" class="form-control" name="name[]" value="'+name+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2">'+
					'<input type="text" class="form-control" name="original[]" value="'+original+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2">'+
					'<input type="text" class="form-control" name="price[]" value="'+price+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2">'+
					'<input type="text" class="form-control" name="quantity[]" value="'+quantity+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2">'+
					'<button type="button" class="btn btn-danger btn-block btn-sm removeRow" id="'+i+'">Cancel</button>'+
				'</div>'+
			'</td>'+

		'</tr>';

		$('#row').append(row);


		$("input[name=prod_id]").val('');
		$("input[name=prod_name]").val('');
		$("input[name=prod_original]").val('');
		$("input[name=prod_price]").val('');
		$("input[name=prod_quantity]").val('');
		$("#productlist2").DataTable();

		
			
		

	});
	$(document).on('click', '.removeRow', function(){
		var id = $(this).attr("id"); 
		$("#productlist2").DataTable().destroy();
		var test = $('#row').find('#row'+id);
		$("#productlist2").DataTable();

	
	});
</script>

@endsection