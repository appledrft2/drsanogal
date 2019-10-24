@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="card card-sm">
				<div class="card-header"><p class="lead float-left">Owner Information</p> <span class="float-right"><a href="/dashboard/client" class="btn btn-default">Go Back</a></span></div>
				<div class="card-body">
					<div class="row">
						<div class="col-7 " >
							<div class=" ">
								<label style="font-size:1em" class="lead">Name:</label>
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
		
			<div class="card collapsed-card">
				<div class="card-header">
					<p class="lead">List of Pets</p>
					<div class="card-tools " >
					    <button type="button" class="btn btn-tool" data-widget="collapse">
					      <i class="fas fa-plus"></i>
					    </button>
					 </div>
				</div>
				<div class="card-body">
					<div class="pull-left mb-3">
						<buttton  class="btn btn-default btn_add"><i class="fa fa-plus-circle"></i> New Pet</buttton>
					</div>	
					<div id="mytable" class="table-responsive">
					<table id="table" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th width="5%">Patient ID</th>
								<th>Name</th>
								<th>Breed</th>
								<th>Gender</th>
								<th>Specie</th>
								<th>Birthday</th>
								<th>Veterinarian</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@if(count($patients))
								@foreach($patients as $key => $patient)
									<tr>
										<td>{{$patient->id}}</td>
										<td>{{$patient->name}}</td>
										<td>{{$patient->breed}}</td>
										<td>{{$patient->gender}}</td>
										<td>{{$patient->specie}}</td>
										<td>{{ date('M d, Y', strtotime($patient->date_of_birth))}}</td>
										<td>{{$patient->veterinarian}}</td>
										<td width="20%">
											<div class="form-inline">
												@if(Auth::user()->role == 'doctor')
												<a style="margin:1px" href="/dashboard/patient/{{$patient->id}}/appointment" class="btn btn-success btn-sm" title="Appointments"><i class="fa fa-calendar-check"></i></a>
												@endif
												<button style="margin:1px" id="{{$patient}}" class="btn btn_add btn-info btn-sm btn_edit"><i class="fa fa-edit" title="Edit"></i></button>
												
												<button style="margin:1px" id="{{$patient->id}}" class="btn btn-danger btn-sm btn_delete" title="Delete"><i class="fa fa-trash"></i></button>
											</div>
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
	        	<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Name" value="" ></div>
	        	<div class="form-group"><input type="text" name="breed" class="form-control " placeholder="Breed" value="" ></div>
	        	<div class="form-group"><input type="date" name="date_of_birth" class="form-control " placeholder="birthday" value="" ></div>
	        	<div class="form-group">
	        		<select name="specie" class="form-control select2" style="width:100%">
	        		<option value="">Species</option>
	        		<option>Canine</option>
	        		<option>Feline</option>
	        		<option>Other</option>
	        		</select>
	        	</div>
	        	<div class="form-group">
	        		<select  name="gender" class="form-control select2" style="width:100%">
	        		<option value="">Gender</option>
	        		<option >Male</option>
	        		<option >Female</option>
	        		<option >Neutered (Male)</option>
	        		<option >Spayed (Female)</option>
	        		</select>
	        	</div>
	        	<!-- <div class="form-group"><input type="text" name="markings" class="form-control " placeholder="markings" value="" ></div> -->
	        	<div class="form-group">
	        		<textarea name="markings" class="form-control" rows="2" placeholder="Markings.."></textarea>
	        	</div>
	        	<!-- <div class="form-group"><input type="text" name="special_considerations" class="form-control " placeholder="Special Considerations (Allergies,Surgeries,etc.)" value="" ></div> -->
	        	<div class="form-group">
	        		<textarea name="special_considerations" class="form-control" rows="2" placeholder="Special Considerations (Allergies,Surgeries,etc.)"></textarea>
	        	</div>
	        	<div class="form-group">
	        	<!-- <input type="text" name="veterinarian" class="form-control " placeholder="Attending Veterinarian" value="" > -->
	        	<select  name="veterinarian" class="form-control select2" style="width:100%">
	        		<option value="" disabled selected>Veterinarian</option>
	        		
	        			@foreach($vets as $vet)
	        				<option>{{$vet->name}}</option>
	        			@endforeach
	        			<option>Other</option>
	        		</select>
             <!--      <label>Veterinarian</label>
                  <select class="select2" multiple="multiple" name="veterinarian[]" data-placeholder="Select a veterinarian"
                          style="width: 100%;">
                    <option>Dr.Sanogal</option>
                    <option>Dr.Doromal</option>
                    <option>Other</option>
                  </select> -->
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
	const Toast = Swal.mixin({
	  toast: true,
	  position: 'top-end',
	  showConfirmButton: false,
	  timer: 3000
	});
</script>
<script type="text/javascript">
	$(document).on('click','.btn_add',function(){
		$('#form').trigger("reset");
	
		$('#form').find('.error_flash').remove();
		$('input[name=_method]').val('POST');
		$('.modal-title').text('New');
		$('.select2').trigger('change');
		$('#Modal').modal('show');
	});
	// btn for editing data
	$(document).on('click','.btn_edit',function(){
		$('#form').trigger("reset");
		
		$('#form').find('.error_flash').remove();
		let data = $(this).attr('id');
		data = JSON.parse(data);
		console.log(data);
		let id = data.id;

		$('input[name=id]').val(id);
		$('input[name=_method]').val('PATCH');
		$('.modal-title').text('Update');
		
        $('input[name=name]').val(data.name);
        $('input[name=breed]').val(data.breed);
        $('select[name=gender]').val(data.gender);
        $('select[name=specie]').val(data.specie);
        $('textarea[name=markings]').val(data.markings);
        $('input[name=date_of_birth]').val(data.date_of_birth);
       
        $('select[name=veterinarian]').val(data.veterinarian);
        $('textarea[name=special_considerations]').val(data.special_considerations);
        $('.select2').trigger('change');
        $('#Modal').modal('show');
	    });

	// btn for inserting/updating data
	$(document).on('click','.btn_save',function(e){
		e.preventDefault();
		$('.select2').trigger("change");
		$('#form').find('.error_flash').remove();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/client/{{$client->id}}/patient';
		let patch = '/dashboard/client/{{$client->id}}/patient/'+id;
		let url = '';

		if(method == "POST"){
			url = post;
		}else if(method == "PATCH"){
			url = patch;
		}
			
		$.ajax({
	        type: "POST",
	        url: url,
	        dataType: "json",
	        data: $('#form').serialize(),
	        beforeSend:function(){
            	$('#loading').prop('hidden',false);
            },
	        success: function(data){
	        	$('#loading').prop('hidden',true);
	        	$('#Modal').modal('hide');
	        	Toast.fire({
	        	  type: 'success',
	        	  title: data.message
	        	});
	        	refreshTable();
	        	console.log(data);
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
	                    url: '/dashboard/client/'+{{$client->id}}+'/patient/'+id,
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
		   	$( "#mytable" ).load( "/dashboard/client/"+{{$client->id}}+"/patient #mytable", function(){
			   $("#table").DataTable({
			   			            dom: 'lBfrtip'
			   			          });
			});
		}
</script>
@endsection