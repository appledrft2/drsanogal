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
				<div class="col-12">
					<div class="form-group ">
						<label>Delivery Code</label>
						<input type="text" name="code" placeholder="Code" value="DC-{{rand(1000,9999)}}" readonly class="form-control">
					</div>
				</div>
				<div class="row">
					<div class="col-6">
						<div class="form-group ">
							<label>Supplier </label>
							<input type="text" name="supplier" placeholder="supplier" value="{{$supplier->name}}" readonly class="form-control">
						</div>
					</div>
					<div class="col-6">
						<div class="form-group ">
							<label>Mode of payment </label>
							<select class="form-control select_mop" name="mop">
								<option selected disabled>Select</option>
								<option>Credit</option>
								<option>Partial</option>
								<option>Cash</option>
							</select>
						</div>
					</div>
				</div>

			</div>

			<div class="col-6">
				<div class="row">
					<div class="form-group col-6">
						<label>Delivery Date</label>
						<input required type="date" value="{{old('delivery_date')}}" name="delivery_date" placeholder="Delivery Date" class="form-control">
					</div>
					<div class="form-group col-6">
						<label>Due Date</label>
						<input required type="date" value="{{old('due')}}" name="due" placeholder="Due" class="form-control">
					</div>
					<div class="form-group col-6">
						<label>Partial</label>
						<input type="text" id="partial" name="partial" disabled value="" class="form-control" placeholder="Enter partial payment">
					</div>
					<div class="form-group col-6">
						<label>Discount</label>
						<select required class="form-control" name="discount">
							<option value="">Select Discount</option>
							<option @if(old('discount') == "0.10") selected @endif  value="0.10">10%</option>
							<option @if(old('discount') == "0.20") selected @endif  value="0.20">20%</option>
							<option @if(old('discount') == "0.30") selected @endif  value="0.30">30%</option>
							<option @if(old('discount') == "0.40") selected @endif  value="0.40">40%</option>
							<option @if(old('discount') == "0.50") selected @endif  value="0.50">50%</option>
							<option @if(old('discount') == "0.60") selected @endif  value="0.60">60%</option>
							<option @if(old('discount') == "0.70") selected @endif  value="0.70">70%</option>
							<option @if(old('discount') == "0.80") selected @endif  value="0.80">80%</option>
							<option @if(old('discount') == "0.90") selected @endif  value="0.90">90%</option>
							<option @if(old('discount') == "0") selected @endif  value="0">No Discount</option>
						</select>
					</div>
				</div>
			</div>

			<div class="col-12">
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
										<th>In Stock</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@if(count($products))
										@foreach($products as $product)
										<tr>
											<td>{{$product->name}}</td>
											<td class="text-right">&#8369; {{number_format($product->original,2)}}</td>
											<td class="text-right">&#8369; {{number_format($product->price,2)}}</td>
											<td>{{$product->quantity}}</td>
											<td><button id="{{$product}}" type="button" class="select_prod btn btn-info btn-sm"><i class="fa fa-shopping-cart"></i> Add to List</button></td>
										</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- <div class="col-4">
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
								<input type="text" name="prod_quantity" placeholder="Quantity to add" class="form-control">
							</div>
							<div class="form-group">
								<button class="btn btn-success btn-block" type="button" id="addRow"><i class="fa fa-shopping-cart"></i> Add Product</button>
							</div>
						</div>
					</div>
				</div>
			</div> -->
			<div class="col-12">
				<div class="card">
					<div class="card-header"><label>Product Table</label></div>
					<div class="card-body">
						<table id="productlist2" class="table table-bordered">
							<thead>
								<tr>
									<th>Name</th>
									<th>Update Original</th>
									<th>Update Selling</th>
									<th>Quantity to add</th>
									
									<th>Action</th>
								</tr>
							</thead>
							<tbody id="row">
								
							</tbody>

						</table>
						<div class="mt-5 float-right">

							<button class="btn btn-primary"><i class="fa fa-truck"></i> Process Delivery</button>
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
	$(document).on('change','.select_mop',function(){
		var choice = $(this).val();
		if(choice == 'Partial'){
			$('#partial').prop('disabled',false);
		}else{
			$('#partial').prop('disabled',true);
		}
	})
</script>

<script type="text/javascript">
	$(document).on('click', '.select_prod', function(){
    var product = $(this).attr("id");
    product = JSON.parse(product);


   			$("#productlist2").DataTable().destroy();
   			var id = product.id;
   			var name = product.name;
   			var original = parseFloat(product.original);
   			original.toFixed(2);
   			var price = parseFloat(product.price);
   			var quantity = product.quantity;
   			var subtotal = product.original * product.quantity;

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
   						'<input type="hidden" class="form-control" readonly name="name[]" value="'+name+'">'+
   					'</div>'+
   				'</td>'+
   				'<td>'+
   					'<div class="form-group mr-2 text-right">'+
   					
   						'<input type="text" class="form-control"  name="original[]" value="'+original+'">'+
   					'</div>'+
   				'</td>'+
   				'<td>'+
   					'<div class="form-group mr-2 text-right">'+
   					
   						'<input type="text" class="form-control"  name="price[]" value="'+price+'">'+
   					'</div>'+
   				'</td>'+
   				'<td>'+
   					'<div class="form-group mr-2">'+
   				
   						'<input type="text" class="form-control"  name="quantity[]" value="'+1+'">'+
   					'</div>'+
   				'</td>'+
   			
   			
   				'<td>'+

   					'<div class="form-group mr-2">'+
   						'<button type="button" class="btn btn-danger btn-block btn-sm removeRow" id="'+i+'">Cancel</button>'+
   					'</div>'+
   				'</td>'+

   			'</tr>';

   			$('#row').append(row);
   			$("#productlist2").DataTable();


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
		var subtotal = original * quantity;

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
					'<input type="hidden" class="form-control" readonly name="name[]" value="'+name+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2 text-right">&#8369;'+
				+
					'<input type="text" class="form-control" readonly name="original[]" value="'+original+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2 text-right">&#8369;'+
				+
					'<input type="text" class="form-control" readonly name="price[]" value="'+price+'">'+
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
				subtotal+
					'<input type="hidden" class="form-control" readonly name="subtotal[]" value="'+subtotal+'">'+
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
		 $('#row').find('#row'+id).remove();
		$("#productlist2").DataTable();

	
	});


</script>

@endsection