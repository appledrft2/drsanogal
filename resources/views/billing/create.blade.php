@extends('layouts.app')
@section('title',$title)
@section('content')
	<span class="form-group"><a href="/dashboard/billing/{{$client->id}}/client" class="btn btn-default">Go Back</a></span>
	<form method="POST" action="/dashboard/billing/{{$client->id}}/client">
		@csrf
	<div class="card mt-3 col-6">
		<div class="card-body">
			<div class=" form-group">
				<label>Receipt #</label>
				<input type="text" readonly name="rcode" class="form-control" value="RS-{{rand(1000,9999)}}">
			</div>
		</div>
	</div>
	@foreach($client->patients as $patient)

		@if(!$patient->appointments->isEmpty())
			<div class="card mt-3">
				<div class="card-body">
					<div class="form-group">
						<label>Patient Name</label>
						<input type="text" class="form-control" name="pname" readonly value="{{$patient->name}}">
					</div>

					<div class="form-group">
						<label>Appointments</label>
						<table class="table table-bordered">
							<thead>
								<tr>
									<td>Appointment</td>
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
												<select required name="isPaid[]" class="form-control">
													
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
		<div class="card">

			<div class="card-body">
				<div class="form-group">
					<label>Patient Name</label>
					<input type="text" class="form-control" name="pname" readonly value="{{$patient->name}}">
				</div>
				<p class="text-center alert alert-info"><i class="fa fa-info float-left"></i> This patient has no appointments yet.</p>
			</div>
		</div>
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

	<div class="card">
		<div class="card-body">
			<button class="float-right btn btn-primary"><i class="fa fa-check"></i> Process Transaction</button>
		</div>
	</div>
	</form>
@endsection

@section('script')
<script type="text/javascript">
	let i = 0;
	$(document).on('click','.btn_add',function(){
		
		$('#table').DataTable().destroy();
		$('#row').append('<tr id="data'+i+'">'+
			'<td>'+
			'<input type="hidden" id="prodid'+i+'" name="hidden_id[]" value="">'+
			'<input type="hidden" id="prodnme'+i+'" name="hidden_prodname[]" value="">'+
			'<select id="'+i+'" required  name="product_name[]" class="prodname form-control">'+
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
			'<input  required placeholder="Quantity" name="product_quantity[]" class="form-control" value="">'+
			'</td>'+
			'<td>'+
			'<button id="'+i+'" class="btn btn_cancel btn-danger"> Cancel</button>'+
			'</td>'+

			'</tr>');

		
		i++;
		$('#table').DataTable();


	});

	$(document).on('click','.btn_cancel',function(){
		let id = $(this).attr('id');
		$('#table').DataTable().destroy();
		$('#row').find('#data'+id).remove();
		$('#table').DataTable();

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
