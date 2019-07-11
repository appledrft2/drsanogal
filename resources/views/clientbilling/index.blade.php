@extends('layouts.app')
@section('title',$title)
@section('content')
<div class="form-group"><a href="/dashboard/client" class="btn btn-default">Go Back</a></div>
<form method="POST" action="/dashboard/client/{{$client->id}}/billing">
	@csrf
<div class="card">
	<div class="card-body">
		
		<div class="row">
			<div class="col-6">
				<div class="form-group">
					<label>Receipt</label>
					<input type="text" class="form-control" readonly name="receipt" value="RS-{{rand(1000,9000)}}">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-8">
				<div class="form-group">
					<div class="card">
						<div class="card-body">
							<label>Product List</label>
							<div class="table-responsive">
								<table id="productlist" class="table table-bordered">
									<thead>
										<tr>
											<th>Name</th>
											<th>Category</th>
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
												<td>{{$product->price}}</td>
												<td>{{$product->quantity}}</td>
												<td>
													<button class="btn btn-block btn-info btn-sm"><i class="fa fa-check"></i> View Detail</button>
												</td>
											</tr>
											@endforeach
										@endif
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<div class="card">
						<div class="card-body">
							<label>Product Details</label>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Name" readonly name="prod_name">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Category" readonly name="prod_category">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Price" readonly name="prod_price">
							</div>
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Quantity"  name="prod_quantity">
							</div>
							<div class="form-group">
								<button class="btn btn-block btn-success" id="addRow"><i class="fa fa-shopping-cart"></i> Add Product</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<label>Cart List</label>
						<div class="table-responsive">
							<table id="productlist2" class="table table-bordered">
								<thead>
									<tr>
									<th>Name</th>
									<th>Category</th>
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
			</div>	
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">

									
					<div class="card">
						<div class="card-header"><label>Services Offered</label></div>
						<div class="card-body">
							
							<div class="form-group">
								@foreach($patients as $patient)
										<div class="form-group">
											<div class="col-12 row">
												<div class="col-6">
													<label>Pet Name:</label>
													{{$patient->name}} <br>
													<label>Pet breed:</label>
													{{$patient->breed}}
												</div>
												<div class="col-6">
													<label>Pet Gender:</label>
													{{$patient->gender}} <br>
													<label>Veterinarian:</label>
													{{$patient->veterinarian}}
												</div>
											</div>
											<div class="card">
												<div class="card-body">
													@foreach($patient->appointments as $appointment)
													
														@if($appointment->isBilled == 1)

															<div class="col-md-12 row">
																<div class="col-md-6">
																	<label>Appointment Description</label>
																	{!!$appointment->description!!}

																	<label>Appointment Status</label>
																	{{$appointment->status}}
																</div>
																<div class="col-md-6">
																	<div class="col-6">
																		<label>Date Visited</label>
																			{{$appointment->date_from}}
																	</div>
																	<div class="col-6">
																		<label>Appintment Date</label>
																			{{$appointment->date_to}}
																	</div>
																</div>
															</div>

																	<div class="table-responsive">
																	<table id="servicelist" class="table table-bordered">
																		<thead>
																			<tr>
																				<th>Type</th>
																				<th>Time</th>
																				<th>Kg</th>
																				<th>Temp</th>
																				<th>Description</th>
																				<th>Price</th>
																			
																			</tr>
																		</thead>
																		<tbody>
																			@foreach($appointment->preventives as $preventive)
																				@if($preventive->status == 'Unpaid')
																					<tr>
																						<td>{{$preventive->type}}</td>
																						<td>{{$preventive->time}}</td>
																						<td>{{$preventive->kg}}</td>
																						<td>{{$preventive->temp}}</td>
																						<td>{!!$preventive->description!!}</td>
																						<td>
																							<input type="hidden" name="preventive_id[]" value="{{$preventive->id}}">

																							{{$preventive->price}}
																							
																						</td>
																		
																					</tr>
																				@endif
																			@endforeach
																		</tbody>
																	</table>
																</div>
																

														@endif
													@endforeach
												</div>
											</div>

										</div>
									@endforeach

									
						
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<button class="btn btn-primary btn-block"> Process Billing</button>
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
					name+
					'<input type="hidden" class="form-control" readonly name="id[]" value="'+id+'">'+
					'<input type="hidden" class="form-control" readonly name="name[]" value="'+name+'">'+
				'</div>'+
			'</td>'+
			'<td>'+
				'<div class="form-group mr-2 text-right">&#8369;'+
				original+
					'<input type="hidden" class="form-control" readonly name="original[]" value="'+original+'">'+
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