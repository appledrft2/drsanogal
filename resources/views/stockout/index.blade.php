@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="form-group"><a href="/dashboard/stockout" class="btn btn-default">Go Back</a></div>
<div class="card">
	<div class="card-body">
		<form method="POST" action="/dashboard/stockout">
		@csrf
		<div class="row mb-5">
			<div class="col-6">
				<div class="form-group ">
					<label>Receipt #</label>
					<input type="text" name="rcode" placeholder="Code" value="RS-{{rand(1000,9999)}}" readonly class="form-control">
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
										<th>Category</th>
										<th>Unit</th>
										<th>Price</th>
										<th>Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(count($products))
										@foreach($products as $product)
										<tr>
											<td>{{$product->name}}</td>
											<td>{{$product->category}}</td>
											<td>{{$product->unit}}</td>
											<td>{{number_format($product->price,2)}}</td>
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
								<input type="hidden" name="prod_id" readonly placeholder="id" class="form-control">
								<input type="hidden" name="prod_original" readonly placeholder="id" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_name" readonly placeholder="Name" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_category" readonly placeholder="Category" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_unit" readonly placeholder="Unit" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_price" readonly placeholder="Price" class="form-control">
							</div>
							<div class="form-group">
								<input type="text" name="prod_quantity" placeholder="Quantity to buy" class="form-control">
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
									<th>Category</th>
									<th>Unit</th>
									<th>Price</th>
									<th>Quantity</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="row">
								
							</tbody>
							
						</table>
					</div>
					<div class="card-footer">
						<div class="float-right">

							<button class="btn btn-primary"><i class="fa fa-check"></i> Process Order</button>
						</div>
					</div>
				</div>
			</div>


		</div>

		</form>
	</div>
</div>
@endsection


@section('script')

<script type="text/javascript">
	$(document).on('click', '.select_prod', function(){
    var product = $(this).attr("id");
    product = JSON.parse(product);

    var price = parseFloat(product.price);

    $("input[name=prod_id]").val(product.id);
    $("input[name=prod_name]").val(product.name);
    $("input[name=prod_category]").val(product.category);
    $("input[name=prod_original").val(product.original);
    $("input[name=prod_unit]").val(product.unit);
    $("input[name=prod_price]").val(price.toFixed(2));
    $("input[name=prod_quantity]").val(1);
  });
</script>

<script type="text/javascript">
	var i = 0;
	var overall = 0;

	$('#addRow').click(function(e){
		e.preventDefault();
		$("#productlist2").DataTable().destroy();
		var id = $("input[name=prod_id]").val();
		var name = $("input[name=prod_name]").val();
		var category = $("input[name=prod_category]").val();
		var unit = $("input[name=prod_unit]").val();
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
					name+
					'<input type="hidden" class="form-control" readonly name="id[]" value="'+id+'">'+
					'<input type="hidden" class="form-control" readonly name="original[]" value="'+original+'">'+
					'<input type="hidden" class="form-control" readonly name="name[]" value="'+name+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2 text-right">'+
				category+
					'<input type="hidden" class="form-control" readonly name="category[]" value="'+category+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2 text-right">'+
				unit+
					'<input type="hidden" class="form-control" readonly name="unit[]" value="'+unit+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2 text-right">&#8369;'+
				price+
					'<input type="hidden" class="form-control" readonly name="price[]" value="'+price+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2">'+
				quantity+
					'<input type="hidden" class="form-control" readonly name="quantity[]" value="'+quantity+'">'+
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
		$("input[name=prod_category]").val('');
		$("input[name=prod_unit]").val('');
		$("input[name=prod_original]").val('');
		$("input[name=prod_price]").val('');
		$("input[name=prod_quantity]").val('');
		$("#productlist2").DataTable();

		
			
		

	});
	$(document).on('click', '.removeRow', function(){
		var id = $(this).attr("id"); 

		$("#productlist2").DataTable().destroy();
		 $('#row').find('#row'+id).remove();
		$("#productlist2").DataTable();

	
	});
</script>

@endsection