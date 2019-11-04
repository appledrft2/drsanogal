@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="card">
		<h4 class="card-header">Upcomming Appointments</h4>
		<div class="card-body">
			
			<div id="mytable" class="table-responsive">
			<table id="tableapplist" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Owner</th>
						<th>Pet</th>
						<th>Appointment</th>

						<th>Date of Appointment</th>
						
						
		
<!-- 						<th>Created at</th> -->
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($appointments))
						@foreach($appointments as $appointment)
							@if($appointment->next_appointment2)
							<tr>
								<td>{{$appointment->patient->client->name}}</td>
						
								<td>{{$appointment->patient->name}}</td>
								<td>{{$appointment->appointment}}</td>
								<td>@if($appointment->next_appointment2) {{date('M d, D Y', strtotime($appointment->next_appointment2))}} @else <span class="badge badge-secondary">No next appointment</span> @endif</td>
							
							
							
							<!-- 	<td>{{date('M d, D Y', strtotime($appointment->created_at))}}</td> -->
								<td>

									<button id="{{$appointment}}" class="btn btn-info btn-sm btn_resched btn-block"><i class="fa fa-sync"></i>&nbsp;&nbsp;Reschedule</button>
										@if(Auth::user()->role == 'doctor')
									<button id="{{$appointment}}" class="btn btn-default btn_edit btn-sm btn-block"><i class="fa fa-info"></i>&nbsp;&nbsp;More Details</button>
									@endif
							
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

	<div class="card">
		<h4 class="card-header">Rescheduled Appointments</h4>
		<div class="card-body table-responsive" id="mytable2">
			<table id="tableapplist2" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>Owner</th>
						<th>Pet</th>
						<th>Appointment</th>
						<th>Previous Date</th>
						<th>Rescheduled Date</th>
					
						<th>SMS notification</th>
					</tr>
				</thead>
				<tbody>
					@foreach($reschedule as $re)
					<tr>
						<td>{{$re->appointment->patient->client->name}}</td>
						<td>{{$re->appointment->patient->name}}</td>
						<td>{{$re->appointment->appointment}}</td>
						<td>{{$re->prev_date}}</td>
						<td>{{$re->reschedule_date}}</td>
				
					
						<td><span class="badge badge-success">Owner is notified</span></td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="resched" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div hidden id="loading">
	      		<div id="overlay" class="overlay d-flex justify-content-center align-items-center">
	      		    <i class="fas fa-2x fa-sync fa-spin"></i>
	      		</div>
	      	</div>
	        <div class="form-group">
	        	<form id="form3">
	        		@csrf
	        		<label>Appointment date</label>
	        		<input type="date" readonly name="prev_date"  class="form-control" >
		        	<label>Rescheduled to</label>
		        	<input type="date" class="form-control" name="reschedule_date">
		        	<input type="hidden" name="appointment_id" value="">
	        	</form>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary btn_confirm">Confirm</button>
	      </div>
	      
	    </div>
	  </div>
	</div>

		<!-- Modal -->
	<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<div hidden id="loading">
	      		<div id="overlay" class="overlay d-flex justify-content-center align-items-center">
	      		    <i class="fas fa-2x fa-sync fa-spin"></i>
	      		</div>
	      	</div>
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
							@if($services)
								@foreach($services as $service)
									<option>{{$service->title}}</option>
								@endforeach
							@endif
							<option>Others</option>
						</select>
					</div>
					<div class="col-12 form-group">
						<label>Next Appointment</label>
						<input readonly type="date" value="" name="next_appointment2" class="form-control next_appointment2" placeholder="Next Appointment">
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
	 $("#tableapplist2").DataTable();
	const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: 3000
	});
</script>
<script type="text/javascript">


	$(document).on('click','.btn_resched',function(){
		let data = $(this).attr('id');
		data = JSON.parse(data);
		$('#form3').trigger("reset");
		$('input[name=prev_date]').val(data.next_appointment2);
		$('.modal-title').text('Reschedule Appointment');
		$('input[name=appointment_id]').val(data.id);
		$('#resched').modal('show');
	})

	$(document).on('click','.btn_confirm',function(e){
		e.preventDefault();
		var form = $('#form3').serialize();
			
			$.ajax({
		        type: 'POST',
		        url: '/dashboard/appointmentlist/reschedule',
		        dataType: "json",
		        data: form,
		        beforeSend:function(){
		        	$('#loading').prop('hidden',false);
		        },
		        success: function(data){
		        	console.log(data);
		        	$('#loading').prop('hidden',true);
		        	$('#resched').modal('hide');

		        	Toast.fire({
		        	  type: 'success',
		        	  title: data.message
		        	});

		        	refreshTable();
		        	refreshTable2();
		        }
		        
		    });
	});
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
		        beforeSend:function(){
		        	$('#loading').prop('hidden',false);
		        },
		        success: function(data){
		        	console.log(data);
		        	$('#loading').prop('hidden',true);
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
		   $("#tableapplist").DataTable();
		});
	}
	function refreshTable2() {  
	   	$( "#mytable2" ).load( "/dashboard/appointmentlist #mytable2", function(){
		   $("#tableapplist2").DataTable();
		});
	}
</script>
@endsection

