@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="form-group"><a href="/dashboard/product" class="btn btn-default">Go Back</a></div>
	<div class="card">
		
		<div class="card-body">
			<div class="form-group mb-3">
				<button class="btn btn-default btn_add"><i class="fa fa-plus-circle"></i> New Category</button>
			</div>
		
				<div class="table-container">
				  <table id="data" class="table table-hover" width="100%">
				  	<thead>
				  		<tr>
				  			<th>#</th>
				  			<th>Title</th>
				  			<th>Description</th>
				  			<th width="20%">Action</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		
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
	        <form id="form">
	        	@csrf
	        	<input type="hidden" name="id" value="">
	        	<input type="hidden" name="_method" value="">
	        	<div class="form-group">
	        		<label>Title</label>
	        		<input type="text" name="title" required class="form-control" placeholder="Title">
	        	</div>
	        	<div class="form-group">
	        		<label>Description</label>
	        			<textarea  class="form-control" cols="5" rows="5" name="description" placeholder="Description"></textarea>
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
	// Server side rendering datatable
	$(document).ready(function(){
		$('#data').DataTable({
			'processing': true,
			'serverSide':true,
			'ajax':'/dashboard/productcategorydata',
			columns:[
			   {
			    data: 'id',
			    name: 'id',
			    orderable: false
			   },
			   {
			    data: 'title',
			    name: 'title'
			   },
			   {
			    data: 'description',
			    name: 'description'
			   },
			   {
			    data: 'action',
			    name: 'action',
			    orderable: false
			   }
			  ]

		});
	});
</script>
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
		$('input[name=_method]').val('POST');
		$('.modal-title').text('New');
		
		$('#Modal').modal('show');
	});
	// btn for editing data
	$(document).on('click','.btn_edit',function(){
		$('#form').trigger("reset");
		let id = $(this).attr('id');
		$('input[name=id]').val(id);
		$('input[name=_method]').val('PATCH');
		$('.modal-title').text('Update');
		

		$.ajax({
	        type: "get",
	        url: "/dashboard/productcategory/"+id+"/edit",
	        dataType: "json",
	        success: function(data){
	            $('input[name=title]').val(data.title);
	            $('textarea[name=description]').val(data.description);
	            $('#Modal').modal('show');
	        },
	        error: function(data){
	            console.log(data);
	        }
	    });

		
	});
	// btn for inserting/updating data
	$(document).on('click','.btn_save',function(e){
		e.preventDefault();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/productcategory';
		let patch = '/dashboard/productcategory/'+id;
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
		        success: function(data){
		        	$('#Modal').modal('hide');
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
                url: '/dashboard/productcategory/'+id,
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

	function refreshTable() {  
	   $('#data').DataTable().ajax.reload();
	}
</script>
@endsection