@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="form-group "><a href="/dashboard/client" class="btn btn-default">Go Back</a></div>
	<div class="card">
		<div class="card-body">
			<div class="float-left ">
				<button class="btn btn-default btn_add" ><i class="fa fa-plus-circle"></i> New Attachment</button>
			</div>
			<div class="float-right mb-5">
				
				<a href="/dashboard/formcategory" class="btn btn-default" ><i class="fa fa-tags"></i> Category</a>
			</div>
			<div id="mytable" class="table-responsive">
			<table id="table" width="100%" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Filename</th>
						<th>Category</th>
						<th>Created at</th>
						<th width="20%">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($forms))	
						@foreach($forms as $key => $form)
							<tr>
								<td>{{$key+1}}</td>
								<td >{{substr($form->file,6)}}</td>
								<td >{{$form->category}}</td>
								<td >{{$form->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</td>
								
								<td>
									<div class="form-group">

										<a href="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$form->file}}" class="btn btn-sm btn-default btn_edit btn-block"><i class="fa fa-download"></i> Download</a>
										<button id="{{$form}}" class="btn btn-sm btn-info btn_edit btn-block"><i class="fa fa-edit"></i> Edit</button>
										<button id="{{$form->id}}" class="btn btn-block btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i> Delete</button>
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
	        <form id="form" enctype="multipart/form-data">
	        
	        	<input type="hidden" name="id" value="">
	        	<input type="hidden" name="_method" value="">
	        	<div class="form-group">
	        		<label>Category</label>
	        		<select name="category" class="form-control select2" style="width: 100%">
	        			<option value="">Select Category</option>
	        			@if($formcategorys)
	        				@foreach($formcategorys as $formcategory)
	        					<option>{{$formcategory->name}}</option>
	        				@endforeach
	        			@endif
	        			<option>Others</option>
	        		</select>
	        	</div>	
	        	<div class="form-group">
	        		<label>Upload Attachments</label>
	        		<div class="form-group" ><span id="img"></span></div>
	        		<input type="file" id="file" name="file" class="form-control-file mb-5">
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
<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
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
		$('.select2').trigger('change');
	
		$('#form').find('.error_flash').remove();
		$('#img').find('#file').remove();
		$('input[name=_method]').val('POST');
		$('.modal-title').text('New');
		$('#Modal').modal('show');
	});
	// btn for editing data
	$(document).on('click','.btn_edit',function(){
		$('#img').find('#file').remove();
		$('#form').trigger("reset");
		$('#form').find('.error_flash').remove();
		let data = $(this).attr('id');
		data = JSON.parse(data);
		let id = data.id;
		$('input[name=id]').val(id);
		$('input[name=_method]').val('PATCH');
		$('.modal-title').text('Update');

        $('select[name=category]').val(data.category);
        $('#img').append('<a id="file" href="https://vetassist.s3.ap-southeast-1.amazonaws.com/'+data.file+'" width="20%">'+data.file.substr(6)+'</a>');
        $('.select2').trigger('change');
        $('#Modal').modal('show');
	      

		
	});
	// btn for inserting/updating data
	$('#form').on('submit',function(e){
		e.preventDefault();
		
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/client/{{$client_id}}/forms';
		let patch = '/dashboard/client/{{$client_id}}/forms/'+id;
		let url = '';


		if(method == "POST"){
			url = post;
		}else if(method == "PATCH"){
			url = patch;
		}
			
		$.ajax({
	        type: "POST",
	        url: url,
	        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
	        data: new FormData(this),
	        contentType: false,
            processData: false,
            cache:false,
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
	        	Toast.fire({
	        	  type: 'error',
	        	  title: 'there was a problem with this record.'
	        	});
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
                url: '/dashboard/client/{{$client_id}}/forms/'+id,
                dataType: "json",
       			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
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
	   	$( "#mytable" ).load( "/dashboard/client/{{$client_id}}/forms #mytable", function(){
		   $("#table").DataTable({
		   			            dom: 'lBfrtip'
		   			          });
		});
	}
</script>
@endsection
