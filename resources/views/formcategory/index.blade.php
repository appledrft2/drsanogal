@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="form-group"><button onclick="GoBackWithRefresh();return false;" class="btn btn-default">Go Back</button></div>
	<div class="card">
		
		<div class="card-body">
			<div class="form-group mb-3">
				<button class="btn btn-default btn_add"><i class="fa fa-plus-circle"></i> New Category</button>
			</div>
		
				<div id="mytable" class="table-container">
				  <table id="table" class="table table-hover" width="100%">
				  	<thead>
				  		<tr>
				  			<th>#</th>
				  			<th>Name</th>
				  			<th>Description</th>
				  			<th width="20%">Action</th>
				  		</tr>
				  	</thead>
				  	<tbody>
				  		@foreach($formcategorys as $key => $formcategory)
				  		<tr>
				  			<td>{{$key + 1}}</td>
				  			<td>{{$formcategory->name}}</td>
				  			<td>{{$formcategory->description}}</td>
				  			<td>
				  				<button id="{{$formcategory}}" class="btn_edit btn btn-info btn-sm"><i class="fa fa-edit"></i> Edit</button>
				  				<button id="{{$formcategory->id}}"  class="btn_delete btn btn-danger btn-sm"><i class="fa fa-trash"></i> Delete</button>
				  			</td>
				  		</tr>
				  		@endforeach
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
	        		<label>Name</label>
	        		<input type="text" name="name" required class="form-control" placeholder="Name">
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
		let id = data.id
		$('input[name=id]').val(id);
		$('input[name=_method]').val('PATCH');
		$('.modal-title').text('Update');
		

		
	            $('input[name=name]').val(data.name);
	            $('textarea[name=description]').val(data.description);
	            $('#Modal').modal('show');
	     

		
	});
	// btn for inserting/updating data
	$(document).on('click','.btn_save',function(e){
		e.preventDefault();
		$('#form').find('.error_flash').remove();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/formcategory';
		let patch = '/dashboard/formcategory/'+id;
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
		        	console.log(data);
		        },
		        error: function(data){
		        	$('#loading').prop('hidden',true);
		        	// display errors on each form field
		        	$.each(data.responseJSON.errors, function (i, error) {
		        	    var el = $(document).find('[name="'+i+'"]');
		        	    el.after($('<span class="error_flash" style="color: red;">'+error[0]+'</span>'));
		        	});
		        	console.log(data);
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
                url: '/dashboard/formcategory/'+id,
                dataType: "json",
                data: $('#form').serialize(),
                success: function(data){
                	Toast.fire({
                	  type: 'success',
                	  title: data.message
                	});
                	refreshTable();
                	console.log(data);
                },
                error: function(data){
                	Toast.fire({
                	  type: 'error',
                	  title: 'there was a problem with this record.'
                	});
                	console.log(data);
                }
            });

	      }

	    });
	});
	// Refresh the table
	function refreshTable() {  
	   	$( "#mytable" ).load( "/dashboard/formcategory #mytable", function(){
		   $("#table").DataTable();
		});
	}
</script>

<script type="text/javascript">
	function GoBackWithRefresh(event) {
	    if ('referrer' in document) {
	        window.location = document.referrer;
	        /* OR */
	        //location.replace(document.referrer);
	    } else {
	        window.history.back();
	    }
	}
</script>
@endsection