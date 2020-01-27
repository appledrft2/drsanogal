@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="form-group"><a href="/dashboard/stockout" class="btn btn-default">Go Back</a></div>
<div class="card">
	<div class="card-body">
		<form id="form1" method="POST" action="/dashboard/stockout">
		@csrf
		<div class="row mb-5">
			<div class="col-6">
				<div class="form-group ">
					<label>Invoice #</label>
					<input type="text" name="rcode" placeholder="Code" value="RS-{{rand(1000,9999)}}" readonly class="form-control">
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
										<th>Category</th>
										<th>Unit</th>
										<th>Price</th>
										<th>Available</th>
										
								
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
											<td><button @if($product->quantity <= 0) disabled @endif id="{{$product}}" type="button" class="select_prod btn btn-info btn-sm"><i class="fa fa-shopping-cart"></i> Add to List</button></td>
										</tr>
										@endforeach
									@endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		<!-- 	<div class="col-4">
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
			</div> -->
			<div class="col-12">
				<div class="card">
					<div class="card-header"><label>Cart</label></div>
					<div class="card-body">
						<table id="testing" class="table table-bordered">
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
					
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="float-right">
							<input type="hidden" id="hsum" name="hsum" value="0">
							<div class="">
								<label>Total Amount:</label>
								<input type="text" class="form-control form-control-sm" name="overallamnt" id="overallamnt" value="0.00" readonly>
							</div>
							<div class="">
								<label>Payment:</label>
								<input type="number" class="form-control form-control-sm" name="payments" id="payment">
							</div>
							<div class="">
								<label>Change:</label>
								<input type="text" class="form-control form-control-sm" name="invoicechange" id="invoicechange" value="0.00" readonly>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="float-right">

							<button id="process" class="btn btn-primary"><i class="fa fa-check"></i> Process Order</button>
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
	$('#testing').DataTable();
	$('#process').click(function(e){
		
		var count = $('#testing tbody tr td').length;
	

		if(count <= 1){
			e.preventDefault();


			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Please add one or more product.'
			
			})

		}else{
			e.preventDefault();	
			Swal.fire({
			  title: 'Are you sure?',
			  text: "You won't be able to revert this!",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6',
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes'
			}).then((result) => {
			if(result.value){
			   $('form').submit();
			  	
			}
			
			});
		

			
		}
	});

	$(document).on('click', '.select_prod', function(){
    var product = $(this).attr("id");
    var sum1 = $('#overallamnt').val();
    product = JSON.parse(product);

    var price = parseFloat(product.price);

    $("#testing").DataTable().destroy();


	if(product.id == ''){
		$("#testing").DataTable();
		return alert('No Product');
	}

	i++;
    var row = '<tr id="row'+i+'">'+
    			'<td>'+
    				'<div class="form-group mr-2">'+
    					product.name+
    					'<input type="hidden" class="form-control" readonly name="id[]" value="'+product.id+'">'+
    					'<input type="hidden" class="form-control" readonly name="original[]" value="'+product.original+'">'+
    					'<input type="hidden" class="form-control" readonly name="name[]" value="'+product.name+'">'+
    				'</div>'+
    			'</td>'+
    			'<td>'+
    				'<div class="form-group mr-2 text-right">'+
    				product.category+
    					'<input type="hidden" class="form-control" readonly name="category[]" value="'+product.category+'">'+
    				'</div>'+
    			'</td>'+
    			'<td>'+
    				'<div class="form-group mr-2 text-right">'+
    				product.unit+
    					'<input type="hidden" class="form-control" readonly name="unit[]" value="'+product.unit+'">'+
    				'</div>'+
    			'</td>'+
    			'<td>'+
    				'<div class="form-group mr-2 text-right">&#8369;'+
    				product.price+
    					'<input type="hidden" class="form-control price'+i+'" readonly name="price[]" value="'+product.price+'">'+
    				'</div>'+
    			'</td>'+
    			'<td>'+
    				'<div class="form-group mr-2">'+
    
    					'<input type="text" id="'+product.price+'" class="form-control getquantity quan'+i+'"  name="quantity[]" value="1">'+
    				'</div>'+
    			'</td>'+
    			'<td>'+
    				'<div class="form-group mr-2">'+
    					'<button type="button" class="btn btn-danger btn-block btn-sm removeRow" id="'+i+'">Cancel</button>'+
    				'</div>'+
    			'</td>'+

    		'</tr>';

    		$('#row').append(row);

    		$("#testing").DataTable();

    		sum1 = parseFloat(sum1) + parseFloat(product.price);
    		sum1 = sum1.toFixed(2);
			$('#overallamnt').val(sum1);

	
  });
</script>
<script type="text/javascript">
	$(document).on('keyup','.getquantity',function(){
		let qprice = $(this).attr('id');
		let quant = $(this).val();
		let oamt = $('#overallamnt').val();

		if(quant == '' || quant == 0){
			quant = 1;
		}

		oamt = parseFloat(oamt) - parseFloat(qprice);

		mult = parseFloat(quant) * parseFloat(qprice);

		oamt = parseFloat(oamt) + parseFloat(mult);

		$('#overallamnt').val(oamt.toFixed(2));

		$(this).prop('readonly',true);

		
	});
</script>
<script type="text/javascript">
	$('#payment').keyup(function(){
		let getoa = $('#overallamnt').val();
		let getpay = $(this).val();

		let newoverall = parseFloat(getpay) - parseFloat(getoa);
		newoverall = newoverall.toFixed(2);

		if(newoverall < 0){
			$('#invoicechange').val(newoverall).css('border','1px solid red');
		}else{
			$('#invoicechange').val(newoverall).css('border','1px solid white')
		}
		
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
		var overamnt = $('#overallamnt').val();
		var currentprdctprice = $('#row').find('#row'+id).find('.price'+id).val();
		var currentprdctquan = $('#row').find('#row'+id).find('.quan'+id).val();

		currentprdctprice = parseFloat(currentprdctprice) * parseFloat(currentprdctquan);

		overamnt = parseFloat(overamnt) - parseFloat(currentprdctprice);

		overamnt = overamnt.toFixed(2);

		$('#overallamnt').val(overamnt);


		$("#testing").DataTable().destroy();
		 $('#row').find('#row'+id).remove();
		$("#testing").DataTable();

	
	});
</script>

@endsection