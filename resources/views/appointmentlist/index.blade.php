@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			
			<div id="mytable" class="table-responsive">
			<table id="tableapplist" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="10%">Patient ID</th>
						<th>Name</th>
						<th>Appointment</th>
						<th>Date of Appointment</th>
						<th>Amount</th>
						
						<th>Payment</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($appointments))
						@foreach($appointments as $appointment)
							@if($appointment->next_appointment2)
							<tr>
								<td>{{$appointment->patient->id}}</td>
								<td>{{$appointment->patient->name}}</td>
								<td>{{$appointment->appointment}}</td>
								<td>@if($appointment->next_appointment2) {{date('M d, D Y', strtotime($appointment->next_appointment2))}} @else <span class="badge badge-secondary">No next appointment</span> @endif</td>
								<td>&#8369; {{number_format($appointment->amount,2)}}</td>
							
								<td>
									@if($appointment->isPaid != '') <span class="badge badge-success">Paid</span> 
									@else <span class="badge badge-secondary">Unpaid</span> 
									@endif
								</td>
								<td>

									<button id="{{$appointment}}" class="btn btn-default btn_edit btn-sm btn-block"><i class="fa fa-info"></i>&nbsp;&nbsp;More Details</button>
							
								</td>
							</tr>
							@endif
						@endforeach
					@else
				<!-- 	<tr><td colspan="8" class="text-center">No Data</td></tr> -->
					@endif
				</tbody>
			</table>
			</div>

		</div>
	</div>

		<!-- Modal -->
	<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <form id="form2">
	        	@csrf
	        	<input type="hidden" name="id" value="">
	        	<input type="hidden" name="_method" value="">
				<div class="row">
					<div class="">
			
						<input  hidden type="date" name="visited"  value="" class="visited form-control" placeholder="Next Appointment">
					</div>
					
					<div class="col-12 form-group">
						<label>Time</label>
	                    <div class="input-group date" id="timepicker" data-target-input="nearest">
	                      <input type="text" value="" class="form-control time datetimepicker-input" name="time" data-target="#timepicker"/>
	                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
	                          <div class="input-group-text"><i class="far fa-clock"></i></div>
	                      </div>
	                      </div>   
					</div>
					<div class="col-6 form-group">
					<label>Temperature</label>
					<input type="text" name="temperature" class="form-control  temperature" placeholder="Temperature">
					</div>
					<div class="col-6 form-group">
						<label>Weight</label>
						<input type="text" name="kilogram" class="form-control  kilogram" placeholder="Weight">
					</div>

					<div class="col-12 form-group">
						<label>Appointment</label>
						<select required name="appointment" class="form-control select2 appointment" style="width:100%">
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
					</div>
					<div class="col-12 form-group">
						<label>Next Appointment</label>
						<input type="date" value="" name="next_appointment2" class="form-control next_appointment2" placeholder="Next Appointment">
					</div>
					<div class="col-12 form-group">
						<label>Price</label>
						<input required type="text" name="price" class="form-control price" placeholder="Price">
					</div>
					<div class="col-12 form-group">
						<label>Description</label>
						<textarea  name="description" class="form-control description" rows="5" placeholder="Description.."></textarea>
					</div>
					
					

				</div>


	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-info btn_save">Save changes</button>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	<!--  -->

@endsection
@section('script')
<script type="text/javascript">
	$('#tableapplist').DataTable({
		"aaSorting": [[3,'desc']]
	});
	const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: 3000
	});
</script>
<script type="text/javascript">
	// btn for editing data
	$(document).on('click','.btn_edit',function(){
		$('#form2').trigger("reset");
		$('#form2').find('.error_flash').remove();
		let data = $(this).attr('id');
		data = JSON.parse(data);

		$('input[name=id]').val(data.id);
		$('input[name=_method]').val('PATCH');
		$('.modal-title').text('Update');
        $('input[name=visited]').val(data.visited);
        $('input[name=time]').val(data.time);
        $('input[name=temperature]').val(data.temperature);
        $('input[name=kilogram]').val(data.kilogram);
        $('select[name=appointment]').val(data.appointment);
        $('input[name=next_appointment2]').val(data.next_appointment2);
        $('input[name=price]').val(data.price);
        $('textarea[name=description]').val(data.description);
        $('.select2').trigger('change');
        $('#ModalEdit').modal('show');
		
	});
	// btn for inserting/updating data
	$(document).on('click','.btn_save',function(e){
		e.preventDefault();
		$('.select2').trigger("change");
		$('#form').find('.error_flash').remove();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/appointmentlist';
		let patch = '/dashboard/appointmentlist/'+id;
		let url = '';
		let form = '';
		url = patch;
		form = $('#form2').serialize();
			
			$.ajax({
		        type: method,
		        url: url,
		        dataType: "json",
		        data: form,
		        success: function(data){
		        	console.log(data);
		        	if(method=='POST'){
		        		$('#Modal').modal('hide');
		        	}else{
		        		$('#ModalEdit').modal('hide');
		        	}
		        	
		        	Toast.fire({
		        	  type: 'success',
		        	  title: data.message
		        	});
		        	refreshTable();
		        },
		        error: function(data){
		        	console.log(data);
		        	// display errors on each form field
		        	$.each(data.responseJSON.errors, function (i, error) {
		        	    var el = $(document).find('[name="'+i+'"]');
		        	    el.after($('<span class="error_flash" style="color: red;">'+error[0]+'</span>'));
		        	});
		        }
		    });

		
	});
	// Refresh the table
	function refreshTable() {  
	   	$( "#mytable" ).load( "/dashboard/appointmentlist #mytable", function(){
		   $("#table").DataTable();
		});
	}
</script>
@endsection

