@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="pull-left mb-3">
				<button class="btn btn-default btn_add"><i class="fa fa-plus-circle"></i> New Announcement</button>
			</div>
			<div id="mytable" class="table-responsive">
			<table id="table" width="100%" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Title</th>
					
						<th>Author</th>
						<th>Created</th>
						<th width="20%">Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($announcements))
					<?php $i=1; ?>
						@foreach($announcements as $announcement)
							<tr>
								<td>{{$i++}}</td>
								<td >{{$announcement->title}}</td>
				
								<td >{{$announcement->user->name}}</td>
								<td >{{$announcement->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</td>
								
								<td>
									<div class="form-inline">
										<button id="{{$announcement->id}}" class="btn btn-sm btn-info btn_edit mr-1"><i class="fa fa-edit"></i> Edit</button>
										<button id="{{$announcement->id}}" class="btn btn-sm btn-danger btn_delete"><i class="fa fa-trash"></i> Delete</button>
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
	        		<label>Title</label>
	        		<input type="text" name="title" required class="form-control" placeholder="Title">
	        	</div>
	        	<div class="form-group">
	        		<label>Description</label>
	        			<textarea  class="form-control textarea " cols="5" rows="5" name="body" placeholder="Description"></textarea>
	        	</div>
	        	<div class="form-group">
	        		<label>Attach an image</label>
	        		<div class="form-group" ><span id="img"></span></div>
	        		<input type="file" id="cover_image" name="cover_image" class="form-control-file mb-5"  accept="image/*">
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
		$('textarea[name=body]').summernote('code','');
		$('#form').find('.error_flash').remove();
		$('#img').find('img').remove();
		$('input[name=_method]').val('POST');
		$('.modal-title').text('New');
		$('#Modal').modal('show');
	});
	// btn for editing data
	$(document).on('click','.btn_edit',function(){
		$('#img').find('img').remove();
		$('#form').trigger("reset");
		$('#form').find('.error_flash').remove();
		let id = $(this).attr('id');
		$('input[name=id]').val(id);
		$('input[name=_method]').val('PATCH');
		$('.modal-title').text('Update');
		

		$.ajax({
	        type: "get",
	        url: "/dashboard/announcement/"+id+"/edit",
	        dataType: "json",
	        beforeSend:function(){
	        	$('#loading').prop('hidden',false);
	        },
	        success: function(data){
	        	$('#loading').prop('hidden',true);
	            $('input[name=title]').val(data.title);
	            $('textarea[name=body]').summernote('code',data.body);
	            $('#img').append('<img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/'+data.cover_image+'" width="20%">');
	            $('#Modal').modal('show');
	        },
	        error: function(data){
	        	$('#loading').prop('hidden',true);
	            console.log(data);
	        }
	    });

		
	});
	// btn for inserting/updating data
	$('#form').on('submit',function(e){
		e.preventDefault();
		
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/announcement';
		let patch = '/dashboard/announcement/'+id;
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
                url: '/dashboard/announcement/'+id,
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
	   	$( "#mytable" ).load( "/dashboard/announcement #mytable", function(){
		   $("#table").DataTable({
		   			            dom: 'lBfrtip'
		   			          });
		});
	}
</script>
@endsection
