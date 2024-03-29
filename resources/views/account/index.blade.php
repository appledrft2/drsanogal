@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class=" mb-3">
				<button class="btn btn_add btn-default"><i class="fa fa-plus-circle"></i> New Account</button >
			</div>
			<div id="mytable" class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
						
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					@if(count($users))
						@foreach($users as $user)
							<tr>
								
								<td>{{$user->name}}</td>
								<td>{{$user->email}}</td>
								<td>{{ucfirst($user->role)}}</td>
								
								<td width="15%">
									<div class="form-inline">
										
										<button style="margin:1px" id="{{$user}}" class="btn btn-info btn-sm btn_edit"><i class="fa fa-edit" title="Edit"></i></button>
								
										<button style="margin:1px" id="{{$user->id}}" class="btn btn-danger btn-sm btn_delete"><i class="fa fa-trash" title="Delete"></i></button>
								
									</div>
								</td>
							</tr>
						@endforeach
					@else
					<tr><td colspan="6" class="text-center">No Data</td></tr>
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
	        	<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Account name" value="" ></div>
				<!-- <div class="form-group"><input type="email" name="email" class="form-control " placeholder="Email" value="" ></div> -->
				<div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
				<div class="form-group">
					<select name="role" class="form-control select2" style="width: 100%">
					<option value="">Role</option>
					<option value="doctor">Doctor</option>
					<option value="staff">Staff</option>
					</select>
				</div>
				<div class="form-group"><input type="password" value="" name="password" class="form-control " placeholder="Password" ></div>
				<div class="form-group"><input type="password" value="" name="password_confirmation" class="form-control " placeholder="Retype Password" ></div>
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
	// btn for adding data
	$(document).on('click','.btn_add',function(){
		$('#form').trigger("reset");
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
		var id = data.id;
		$('input[name=id]').val(id);
		$('input[name=_method]').val('PATCH');
		$('.modal-title').text('Update');
		

        $('input[name=name]').val(data.name);
        $('input[name=email]').val(data.email);
        $('select[name=role]').val(data.role)
        $('input[name=password]').val('').before($('<div class="alert alert-info error_flash" style="color: red;"><i class="fa fa-key"></i> Leave the password field empty if you dont want to change.</div>'));
        $('input[name=password_confirmation]').val('');
        $('.select2').trigger('change');
        
        $('#Modal').modal('show');
	      

		
	});
	// btn for inserting/updating data
	$(document).on('click','.btn_save',function(e){
		e.preventDefault();
		$('#form').find('.error_flash').remove();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/account';
		let patch = '/dashboard/account/'+id;
		let url = '';

		if(method == "POST"){
			url = post;
		}else if(method == "PATCH"){
			url = patch;
		}
			
			$.ajax({
		        type: method,
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
		        	$('#loading').html('hidden',true);
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
                url: '/dashboard/account/'+id,
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
	   	$( "#mytable" ).load( "/dashboard/account #mytable", function(){
		   $("#table").DataTable({
		   			            dom: 'lBfrtip'
		   			          });
		});
	}
</script>
@endsection