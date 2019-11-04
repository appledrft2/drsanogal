@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="card">
		<div class="card-body">
			<div class="card card-sm">
				<div class="card-header"><p class="lead float-left">Pet Information</p> 
				<!-- <span class="float-right"><a href="/dashboard/patient" class="btn btn-default">Patient List</a></span> -->
				<span class="float-right"><a href="/dashboard/client/{{$patient->client->id}}/patient" class=" mr-3 btn btn-default">Go Back</a></span>
				</div>
				
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<div class="">
								<label style="font-size:1em" class="lead">Owner:</label>
								<span class="lead " style="font-size:1em">{{$patient->client->name}}</span>
							</div>
							<div class="">
								<label style="font-size:1em" class="lead">Name:</label>
								<span class="lead " style="font-size:1em">{{$patient->name}}</span>
							</div>

							<div class="">
								<label style="font-size:1em" class="lead">Breed:</label>
								<span class="lead " style="font-size:1em">{{$patient->breed}}</span>
							</div>

							<div class="">
								<label style="font-size:1em" class="lead">Gender:</label>
								<span class="lead " style="font-size:1em">{{$patient->gender}}</span>
							</div>
							
							<div class="">
								<label style="font-size:1em" class="lead">Specie:</label>
								<span class="lead " style="font-size:1em">{{$patient->specie}}</span>
							</div>
							<div class="">
								<label style="font-size:1em" class="lead">Date of Birth:</label>
								<span class="lead " style="font-size:1em">{{date('M d, Y', strtotime($patient->date_of_birth))}}</span>
							</div>
							
							
						</div>
						<div class="col-4">
							<div class="">
								<label style="font-size:1em" class=" lead">Markings:</label>
								<div class="">
									<span class="lead " style="font-size:1em">{{$patient->markings}}</span>
								</div>
							</div>
							
							<div class="">
								<label style="font-size:1em" class="lead">Special <br>Considerations:</label>
								<div class="">
									<span class="lead " style="font-size:1em">{{$patient->special_considerations}}</span>
								</div>
							</div>
							
							<div class="">
								<div class="">
								<label style="font-size:1em" class="lead">Veterinarian: </label>
										<br>
									<span class="lead " style="font-size:1em"> {{$patient->veterinarian}}</span>
								</div>
							</div>
							
							
						</div>
						<div class="col-4">
							<br><br><br>
							<div class="">
								<img src="{{asset('adminlte3/dist/img/logo.jpg')}}" class="img-fluid" style="border-radius: 90%;width: 30%">
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="card collapsed-card">
				<div class="card-header">
					<p class="lead">List of Appointments</p>
					<div class="card-tools " >
					    <button type="button" class="btn btn-tool" data-widget="collapse">
					      <i class="fas fa-angle-down"></i>
					    </button>
				


					 </div>
				</div>
				<div class="card-body">
					<div class="float-left mb-3">
						<button class="btn btn_add btn-default "><i class="fa fa-plus-circle"></i> New Appointment</button>
					</div>
					
					
					
					<div id="mytable" class="table-responsive">
					<table id="table" class="table table-bordered table-hover">
						<thead>
							<tr>
								
								<th>Appointment</th>
								
								<th>Next appointment</th>
								<th>Amount</th>
								
								<th>Payment</th>
								<th>Date Visited</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
							@if(count($appointments))
								@foreach($appointments as $appointment)
									<tr>
									
										<td>{{$appointment->appointment}}</td>
								
										<td>@if($appointment->next_appointment2) {{date('M d, D Y', strtotime($appointment->next_appointment2))}} @else <span class="badge badge-secondary">No next appointment</span> @endif</td>
									
										<td>&#8369; {{number_format($appointment->amount,2)}}</td>
										
										<td>
											@if($appointment->isPaid != '') <span class="badge badge-success">Paid</span> 
											@else <span class="badge badge-secondary">Unpaid</span> 
											@endif
										</td>
										<td>{{date('M d, D Y', strtotime($appointment->created_at))}}</td>
										<td>
											<button style="margin:1px" id="{{$appointment}}" class=" btn-sm btn btn-info btn_edit"><i class="fa fa-edit"></i></button>

											<button style="margin:1px" id="{{$appointment->id}}" class="btn btn-danger btn-sm btn_delete"><i class="fa fa-trash"></i></button>
										</td>
									</tr>
								@endforeach
							@else
							
							@endif
						</tbody>
					</table>
					</div>
				</div>
			</div>

		</div>
	</div>
<!-- Modal -->
	<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
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
	        <form id="form">
	        	@csrf
	        	<input type="hidden" name="id" value="">
	        	<input type="hidden" name="_method" value="">
				<div class="row">
			
						<input  hidden type="date" name="visited"  value="{{date('Y-m-d')}}" class="form-control" placeholder="Next Appointment">
					
					
					<div class="col-12 form-group">
						<label>Time</label>
	                    <div class="input-group date" id="timepicker" data-target-input="nearest">
	                      <input type="text" value="{{date('h:m A')}}" class="form-control datetimepicker-input" name="time" data-target="#timepicker"/>
	                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
	                          <div class="input-group-text"><i class="far fa-clock"></i></div>
	                      </div>
	                      </div>   
					</div>
					<div class="col-6 form-group">
					<label>Temperature (C)</label>
					<input type="text" name="temperature" class="form-control  " placeholder="Temperature">
					</div>
					<div class="col-6 form-group">
						<label>Weight (Kg)</label>
						<input type="text" name="kilogram" class="form-control  " placeholder="Weight">
					</div>

					<div class="col-12 form-group">
						<label>Service Rendered</label>
						<select required name="appointment[]" class="form-control select2" style="width:100%">
							<option value="">Select Service</option>
					
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
						<input type="date" value="" name="next_appointment2[]" class="form-control" placeholder="Next Appointment">
					</div>
					<div class="col-12 form-group">
						<label>Price</label>
						<input required type="text" name="price[]" class="form-control" placeholder="Price">
					</div>
					<div class="col-12 form-group">
						<label>Findings</label>
						<textarea  name="description[]" class="form-control" rows="5" placeholder="Findings.."></textarea>
					</div>
					<div id="rows" class="col-12 form-group">
						
					</div>
					<div id="btnRows" class="col-12 form-group">
						<button type="button" class="btn btn-default" id="add"><i class="fa fa-plus-circle"></i> Add</button>
						<button type="button" class="btn btn-default" id="remove"><i class="fa fa-minus-circle"></i> Remove</button>
					</div>

				</div>


	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <div class="float-right">
	        	<button type="button" class="btn btn-info btn_save"  value="0">Save Changes</button>

	        </div>

	        
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
	<!--  -->

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
				
						<input hidden  type="date" name="visited"  value="" class="visited form-control" placeholder="Next Appointment">
				
					
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
	let i = 0;
	$('#add').click(function(){
		i++;
		$('#rows').append('<div class="data'+i+'"><hr>'+
			'<label>Appointment</label>'+
			'<select required name="appointment[]" class="form-control mb-1 select3" style="width:100%">'+
			'<option value="">Select Appointment</option>'+
			
			'@if($services)'+
				'@foreach($services as $service)'+
					'<option>{{$service->title}}</option>'+
				'@endforeach'+
			'@endif'+
			'<option>Others</option>'+
			'</select>'+
			'</div>'+
			'<div class="data'+i+'">'+
			'<label>Next Appointment</label>'+
			'<input type="date" name="next_appointment2[]" class="form-control mb-1" placeholder="Next Appointment">'+
			'<label>Price</label>'+
			'<input required type="text" name="price[]" class="form-control mb-1" placeholder="Price">'+
			'<label>Description</label>'+
			'<textarea  name="description[]" class="form-control" rows="5" cols="5" placeholder="Description"></textarea>'+
			'</div>');
		$('.select3').select2();
		
	});

	$('#remove').click(function(){
		
		if(i != 0){
			$('#rows').find('.data'+i).remove();
			i--;
		}
	});

</script>
<script type="text/javascript">
	const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: 3000
	});
</script>
<script type="text/javascript">
	// btn for adding data
	$(document).on('click','.btn_add',function(){
		$('#form').trigger("reset");
		$('.select2').trigger("change");
		$('#form').find('.error_flash').remove();
		while(i != 0 ){
			$('#rows').find('.data'+i).remove();
			i--;
		}
		$('input[name=_method]').val('POST');
		$('.modal-title').text('New');
		
		$('#Modal').modal('show');
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
		let choice = $(this).val();
		$('.select2').trigger("change");
		$('#form').find('.error_flash').remove();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/patient/{{$patient->id}}/appointment';
		let patch = '/dashboard/patient/{{$patient->id}}/appointment/'+id;
		let url = '';
		let form = '';

		if(method == "POST"){
			url = post;
			form = $('#form').serialize();
		}else if(method == "PATCH"){
			url = patch;
			form = $('#form2').serialize();
		}
			
			$.ajax({
		        type: method,
		        url: url,
		        dataType: "json",
		        data: form,
		        beforeSend:function(){
		        	$('#loading').prop('hidden',false);
		        },
		        success: function(data){
		        	$('#loading').prop('hidden',true);
		        	console.log(data);
		        	if(method=='POST'){
		        		if(choice == 1){
		        		
		        			window.location.href="/dashboard/billing/{{$patient->client->id}}/client/create";
		        		}else{
		        			$('#Modal').modal('hide');
		        		}
		        		
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
		        	$('#loading').prop('hidden',true);
		        	console.log(data);
		        	// display errors on each form field
		        	$.each(data.responseJSON.errors, function (i, error) {
		        	    var el = $(document).find('[name="'+i+'"]');
		        	    el.after($('<span class="error_flash" style="color: red;">'+error[0]+'</span>'));
		        	});
		        }
		    });

		
	});

	// btn for deleting data
	$(document).on('click', '.btn_delete', function(){

	    let id = $(this).attr('id');

	    Swal.fire({
	      title: 'Are you sure?',
	      text: "You won't be able to revert this!",
	      type: 'warning',
	      showCancelButton: true,
	      confirmButtonColor: '#3085d6',
	      cancelButtonColor: '#d33',
	      confirmButtonText: 'Yes, delete it!'
	    }).then((result) => {

	      if (result.value) {

        	$.ajax({
                type: "DELETE",
                url: '/dashboard/patient/{{$patient->id}}/appointment/'+id,
                dataType: "json",
                data: $('#form').serialize(),
                success: function(data){
                	Toast.fire({
                	  type: 'success',
                	  title: data.message
                	});
                	refreshTable();
                },
                error: function(data){
                	Toast.fire({
                	  type: 'error',
                	  title: 'there was a problem with this record.'
                	});
                }
            });

	      }

	    });
	});
	// Refresh the table
	function refreshTable() {  
	   	$( "#mytable" ).load( "/dashboard/patient/{{$patient->id}}/appointment #mytable", function(){
		   $("#table").DataTable({
		   			            dom: 'lBfrtip'
		   			          });
		});
	}
</script>
@endsection

