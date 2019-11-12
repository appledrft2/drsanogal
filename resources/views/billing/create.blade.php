@extends('layouts.app')
@section('title',$title)
@section('content')
	<span class="form-group"><a href="/dashboard/billing/{{$client->id}}/client" class="btn btn-default">Go Back</a></span>
	<form method="POST" action="/dashboard/billing/{{$client->id}}/client">
		@csrf
	<div class="card mt-3 col-6">
		<div class="card-body">
			<div class=" form-group">
				<label>Invoice #</label>
				<input type="text" readonly name="rcode" class="form-control" value="RS-{{rand(1000,9999)}}">
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-7 " >
					<div class=" ">
						<label style="font-size:1em" class="lead">Client Name:</label>
						<span class="lead" style="font-size: 1em">{{$client->name}}</span>
					</div>
					
					<div class="">
						<label style="font-size:1em" class="lead">Gender:</label>
						<span class="lead" style="font-size: 1em">{{$client->gender}}</span>
					</div>
					
					<div class="">
						<label style="font-size:1em" class="lead">Contact:</label>
						<span class="lead" style="font-size: 1em">{{$client->contact}}</span>
					</div>
					
					<div class="">
						<div class="form-inline">
							<label style="font-size:1em" class=" lead">Address:</label>&nbsp;
							<span class="lead" style="font-size: 1em">{!!$client->address!!}</span>
						</div>
					</div>
				</div>
				<div class="col-5">
					<div class="float-right">
						<img src="@if($client->gender == 'Male') {{asset('adminlte3/dist/img/male.png')}} @else {{asset('adminlte3/dist/img/female.png')}} @endif" class="img-fluid" style="border-radius: 90%;width: 30%">
					</div>
				</div>
			</div>

		</div>
	</div>
	@foreach($client->patients as $patient)
		
		@if(!$patient->appointments->isEmpty())
			<div class="card mt-3">
				<div class="card-body">
					<div class="form-group">
						<label>Pet Name</label>
						<input type="text" class="form-control" name="pname" readonly value="{{$patient->name}}">
					</div>

					<div class="form-group">
						<label>Services Rendered</label>
						<table id="appointmnt" class="table table-bordered">
							<thead>
								<tr>
									<td>Service </td>
									<td>Amount</td>
							
									<td>Payment</td>
									<td>Action</td>
								</tr>
							</thead>
							<tbody>

								
								@foreach($patient->appointments as $appointment)
							
										@if($appointment->isPaid == 0)
										
										<tr>
											<td>
												<input type="hidden" name="hidden_appointment_id[]" value="{{$appointment->id}}">
												<input readonly type="text" class="form-control" name="appointment[]" value="{{$appointment->appointment}}"></td>
											<td><input readonly type="text" class="form-control" name="amount[]" value="{{$appointment->amount}}"></td>
											<td>
												@if($appointment->isPaid == 0) <span class="badge badge-secondary"> Unpaid</span> @else <span class="badge badge-success"> Paid</span>@endif
											</td>
											
											<td>
												<select id="{{$appointment->amount}}" required name="isPaid[]" class="form-control ispaidchange">
													
													<option value="0">Unpaid</option>
													<option value="1">Paid</option>
												</select>
											</td>
											

										</tr>
								
										@endif

									
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>

		@else
	
		@endif

	@endforeach
	<div>
		

	</div>
	<div class="card">
		<div class="card-body">
			<div class="form-group mb-3">
				<button class="btn btn_add btn-default"><i class="fa fa-plus-circle"></i> Add Product</button>
			</div>
			<div class="form-group">
				<table id="table" width="100%" class="table table-bordered">
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
	<div class="card" >
		<div class="card-body">
			<div class="float-right">
				<div class="col-md-12 ">
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
	<div class="card">
		<div class="card-body">
			<button id="process" class="float-right btn btn-primary"><i class="fa fa-check"></i> Process Transaction</button>
		</div>
	</div>
	</form>
@endsection

@section('script')
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

	let total_amount = 0;
	$(document).on('change','.ispaidchange',function(){
		let service_price = $(this).attr('id');
		let status = $(this).val();
		if(status == 1){
			total_amount = parseFloat(service_price) + parseFloat(total_amount);

			total_amount = total_amount.toFixed(2);

			$('input[name=overallamnt').val(total_amount);
		}else{
			total_amount = parseFloat(total_amount) - parseFloat(service_price) ;
			total_amount = total_amount.toFixed(2);
			$('input[name=overallamnt').val(total_amount);
		}

		

	});

	$(document).on('change','.getprodprice',function(){
		let geti = $(this).attr('id');
		setTimeout(function(){ 


	    let prod_price = $('#row').find('#prodprice'+geti).val();
	    let prod_quan = $('#row').find('.prodquan'+geti).val();

	    prod_price = parseFloat(prod_price) * parseFloat(prod_quan);


		if(prod_price == ''){
			prod_price = 0;
		}

			total_amount = parseFloat(prod_price) + parseFloat(total_amount);

			total_amount = total_amount.toFixed(2);

			$('input[name=overallamnt').val(total_amount);

			$(this).prop('readonly', true);

		 }, 500);

		$(this).css('pointer-events','none').css('background-color','#e9ecef');
		

	});

	$(document).on('keyup','.getprodquantity',function(){
		let quanid = $(this).attr('id');
		let prod_price2 = $('#row').find('#prodprice'+quanid).val();
		let quanval = $(this).val();
		total_amount = parseFloat(total_amount) -  parseFloat(prod_price2);
		prod_price2 = parseFloat(prod_price2) * parseFloat(quanval);

		total_amount = parseFloat(prod_price2) + parseFloat(total_amount);

			total_amount = total_amount.toFixed(2);

	
			$('input[name=overallamnt').val(total_amount);
			

			$(this).prop('readonly',true);
			

	});




	$('#process').click(function(e){
		
		var count = 0;

		$('select[name^="isPaid"]').each( function() {
	        

	        if(this.value == 1){
	        	count++;
	        }
	    });

		if(count < 1){
			e.preventDefault();
		
			Swal.fire({
			  icon: 'error',
			  title: 'Oops...',
			  text: 'Please pay one or more unpaid appointments.'
			
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
</script>
<script type="text/javascript">

	let i = 0;
	$(document).on('click','.btn_add',function(){
		
		$('#table').DataTable().destroy();
		$('#row').append('<tr id="data'+i+'">'+
			'<td>'+
			'<input type="hidden" id="prodid'+i+'" name="hidden_id[]" value="">'+
			'<input type="hidden" id="prodnme'+i+'" name="hidden_prodname[]" value="">'+
			'<select id="'+i+'" required  name="product_name[]" class="prodname form-control getprodprice">'+
			'<option value="">Select Product</option>'+
			'@foreach($products as $product)'+
				'<option value="{{$product}}" >{{$product->name}}</option>'+
			'@endforeach'+
			'</select>'+
			'</td>'+
			'<td>'+
			'<input readonly id="prodcat'+i+'" name="product_category[]" class="form-control" value="">'+
			'</td>'+
			'<td>'+
			'<input readonly id="produnit'+i+'" name="product_unit[]" class="form-control" value="">'+
			'</td>'+
			'<td>'+
			'<input readonly id="prodprice'+i+'" name="product_price[]" class="form-control" value="">'+
			'</td>'+
			'<td>'+
			'<input  required id="'+i+'" placeholder="Quantity" name="product_quantity[]" class="form-control prodquan'+i+' getprodquantity"  value="1">'+
			'</td>'+
			'<td>'+
			'<button id="'+i+'" class="btn btn_cancel btn-danger btn-sm"> x</button>'+
			'</td>'+

			'</tr>');

		
		i++;
		$('#table').DataTable();


	});

	$(document).on('click','.btn_cancel',function(e){
		let id = $(this).attr('id');
		e.preventDefault();





	    let prod_price = $('#row').find('#prodprice'+id).val();
	    let prod_quan = $('#row').find('.prodquan'+id).val();

	    prod_price = parseFloat(prod_price) * parseFloat(prod_quan);


		if(prod_price == ''){
			prod_price = 0;
		}

			total_amount = parseFloat(total_amount) - parseFloat(prod_price);

			total_amount = total_amount.toFixed(2);

			$('input[name=overallamnt').val(total_amount);

			$(this).prop('readonly', true);

		 
		setTimeout(function(){ 
		$('#table').DataTable().destroy();
		$('#row').find('#data'+id).remove();
		$('#table').DataTable();
		},100);

	});

	$(document).on('change','.prodname',function(){
		
		let id = $(this).attr('id');
		let data = this.value;
		data = JSON.parse(data);

		$('#row').find('#prodid'+id).val(data.id);
		$('#row').find('#prodnme'+id).val(data.name);
		$('#row').find('#prodcat'+id).val(data.category);
		$('#row').find('#produnit'+id).val(data.unit);
		$('#row').find('#prodprice'+id).val(data.price);

	});
</script>
@endsection
