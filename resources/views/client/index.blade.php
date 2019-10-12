@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="pull-left mb-3">
				<button class="btn btn_add btn-default"><i class="fa fa-plus-circle"></i> New Client</button>
			</div>
			<div id="mytable" class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Occupation</th>
						<th>Address</th>
						<th>Pets</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($clients))
					<?php $i=1; ?>
						@foreach($clients as $client)
							<tr>
								<td >{{$i++}}</td>
								<td >{{$client->name}}</td>
								<td >{{$client->gender}}</td>
								<td >{{$client->occupation}}</td>
								<td>{{str_limit($client->address, 15)}}</td>
								<td ><a href="/dashboard/client/{{$client->id}}/patient" class="text-bold">{{$client->patients->count()}}</a></td>
								<td width="15%">
									<div class="form-inline">
										@if(Auth::user()->role == 'doctor')
										<a href="/dashboard/client/{{$client->id}}/forms" class="btn btn-block btn-default btn-sm btn-block"><i class="fa fa-folder"></i> Attachments</a>
										@endif
										<a href="/dashboard/client/{{$client->id}}/patient" class="btn btn-block btn-success btn-sm btn-block"><i class="fa fa-paw"></i> Manage Pets</a>
										<button id="{{$client}}" class="btn btn_edit btn-block btn-info btn-sm "><i class="fa fa-edit"></i> Edit </button>
									
										<button id="{{$client->id}}" class="btn btn-danger btn-block btn-sm btn_delete"><i class="fa fa-trash"></i> Delete</button>
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
	        	<div class="form-group">
	        		<input type="text" name="name" class="form-control " placeholder="Client name" value="" >
	        	</div>
				<div class="form-group">
					<select name="gender" class="form-control select2" style="width:100%">
					<option value="">Gender</option>
					<option>Male</option>
					<option>Female</option>
					</select>
				</div>
				<div class="form-group">
					<input type="text" name="occupation" class="form-control " placeholder="Occupation" value="" >
				</div>
				<div class="form-group">
					<label>Contact Numbers</label>
					
						<!-- <div class="form-group "><input type="number" value="" name="contact" class="form-control " placeholder="Mobile" ></div> -->	
						<div class="input-group mb-3">
		                  <div class="input-group-prepend">
		                    <span class="input-group-text"><i class="fas fa-address-book"></i></span>
		                  </div>
		                  <input type="number" name="contact" class="form-control" placeholder="Mobile number">
		                </div>
						<!-- <div class="form-group "><input type="number" value="" name="work" class="form-control " placeholder="Work" ></div> -->
						<div class="input-group mb-3">
		                  <div class="input-group-prepend">
		                    <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
		                  </div>
		                  <input type="number" name="work" class="form-control" placeholder="Work">
		                </div>
						<!-- <div class="form-group "><input type="number" value="" name="home" class="form-control " placeholder="Home" ></div>	 -->
						<div class="input-group mb-3">
		                  <div class="input-group-prepend">
		                    <span class="input-group-text"><i class="fas fa-home"></i></span>
		                  </div>
		                  <input type="number" name="home" class="form-control" placeholder="Home">
		                </div>
						<div class="form-group ">
							<select name="smsNotify" class="form-control select2" style="width:100%">
								<option value="">Which number to notify</option>
								<option>Mobile</option>
								<option>Home</option>
								<option>Work</option>
								<option>None</option>
							</select>
						</div>

				</div>
				<hr>	
				<div class="form-group">
					<label>Email</label>
					<!-- <input type="email" value="" name="email" class="form-control " placeholder="Email Address" ></div>	 -->
					<div class="input-group mb-3">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
	                  </div>
	                  <input type="email" name="email" class="form-control" placeholder="Email Address">
	                </div>
	            </div>
				<div class="form-group">
					<label>Address</label>
					<textarea class="form-control" id="address" name="address" cols="5" rows="5" placeholder="Address"></textarea>
				</div>
				<div class="form-group">
					<div id="form-errors"></div>
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
		$('.select2').trigger('change');
		$('#form').find('.error_flash').remove();
		$('input[name=_method]').val('POST');
		$('.modal-title').text('New');
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
        $('select[name=gender]').val(data.gender);
        $('input[name=occupation]').val(data.occupation);
        $('input[name=contact]').val(data.contact);
        $('input[name=work]').val(data.work);
        $('input[name=home]').val(data.home);
        $('select[name=smsNotify]').val(data.smsNotify);
        $('input[name=email]').val(data.email);
        $('#address').val(data.address);
        $('.select2').trigger('change');
        $('#Modal').modal('show');
	    });

	// btn for inserting/updating data
	$(document).on('click','.btn_save',function(e){
		e.preventDefault();
		$('.select2').trigger('change');
		$('#form').find('.error_flash').remove();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/client';
		let patch = '/dashboard/client/'+id;
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
	                    url: '/dashboard/client/'+id,
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
		   	$( "#mytable" ).load( "/dashboard/client #mytable", function(){
			  $("#table").DataTable({
			            dom: 'lBfrtip'
			          });
			});
		}
</script>
@endsection