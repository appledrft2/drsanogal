@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/patient/{{$patient}}/appointment" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">New Appointment</div>
		<div class="card-body">
			    <div class="form-group">
				    <form method="post" action="/dashboard/patient/{{$patient}}/appointment">
				    	@csrf
						<div class="form-group col-12 mx-auto mt-2">
							<table class="col-12">
							
								<tbody id="row">
									<tr>
										<td>
											<div class="row">
												<div class="col-6">
													<label>Next Appointment</label>
													<input type="date" name="next_appointment" class="form-control mb-1" placeholder="Next Appointment">
													
												</div>
												<div class="col-6">
													<label>Time</label>
													<input type="time" name="time" class="form-control mb-1" placeholder="Time">	
												</div>
											</div>							
											<div class="row">
												<span class="col-6">
												<label>Temp</label>
												<input type="number" name="temperature" class="form-control mb-1 " placeholder="Temperature"></span>
												<span class="col-6">
													<label>Kilogram</label>
													<input type="number" name="kilogram" class="form-control mb-1 " placeholder="Kilogram">
												</span>
											</div>
											<label>Appointment</label>
											<select name="appointment[]" class="form-control mb-1">
												<option value="">Select Appointment</option>
												<option>5in1 Vaccination</option>
												<option>Deworming</option>
												<option>Rabies Vaccination</option>
												<option>Bordetella</option>
												<option>Leptospirosis</option>
												<option>Heartworm Prevention</option>
												<option>Tick and Flea Prevention</option>
												<option>Manage Treatment</option>
												<option>Laboratory</option>
												<option>Check-up</option>
												<option>Others</option>

											</select>
											<label>Price</label>
											<input type="number" name="price[]" class="form-control mb-1" placeholder="Price">
											<label>Description</label>
											<textarea name="description[]" class="form-control" rows="5" cols="5" placeholder="Description"></textarea>
										</td>
									</tr>
								</tbody>
								<tfoot>
									<tr>
										<td>
											<button type="button" class="btn btn-info" id="add">Add</button>
											<button type="button" class="btn btn-danger" id="remove">Remove</button>
										</td>
									</tr>
								</tfoot>
							</table>
							<button type="submit" class="btn btn-secondary mt-5 btn-block">Submit</button>
						</div>
				    </form>
			    </div>
			   
		</div>
	</div>
</div>
@endsection
@section('script')
    <script type="text/javascript">
    	var i = 2;
		$('#add').click(function(){
			
			$('#row').append('<tr id="data'+i+'"><td>'+
				'<label>Appointment #'+i+'</label>'+
				'<select name="appointment[]" class="form-control mb-1">'+
				'<option value="">Select Appointment</option>'+
				'<option>5in1 Vaccination</option>'+
				'<option>Deworming</option>'+
				'<option>Rabies Vaccination</option>'+
				'<option>Bordetella</option>'+
				'<option>Leptospirosis</option>'+
				'<option>Heartworm Prevention</option>'+
				'<option>Tick and Flea Prevention</option>'+
				'<option>Manage Treatment</option>'+
				'<option>Laboratory</option>'+
				'<option>Check-up</option>'+
				'<option>Others</option>'+
				'</select>'+
				'<label>Price</label>'+
				'<input type="number" name="price[]" class="form-control mb-1" placeholder="Price">'+
				'<label>Description</label>'+
				'<textarea name="description[]" class="form-control" rows="5" cols="5" placeholder="Description"></textarea>'+
				'</td></tr>');
			i++;
		});

		$('#remove').click(function(){
			if(i >= 3){
				i--;
				$('#row').find('#data'+i).remove();
			}	
		});
	</script>
@endsection