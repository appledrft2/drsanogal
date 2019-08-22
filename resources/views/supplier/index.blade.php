@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="pull-left mb-3">
				<button class="btn btn-default btn_add"><i class="fa fa-plus-circle"></i>New Supplier</button>
			</div>
			<div id="mytable" class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Contact</th>
						<th>Address</th>
						<!-- <th width="20%">Products in stock</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($suppliers))
					<?php $i=1; ?>
						@foreach($suppliers as $supplier)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$supplier->name}}</td>
								<td>{{$supplier->contact}}</td>
								<td>{{str_limit($supplier->address, 15)}}</td>
								<!-- <th><form method="post" action="/dashboard/product/search">@csrf<input type="hidden" name="data" value="{{$supplier->id}}"><button class="btn btn-link">{{$supplier->products->count()}}</button></form></th> -->
								<td width="15%">	
									<!-- <a href="/dashboard/suppliers/{{$supplier->id}}/stockin" class="btn btn-default btn-sm btn-block"><i class="fa fa-truck"></i> &nbsp;Stock In</a> -->
									<button id="{{$supplier}}" class="btn btn-info btn-sm btn-block btn_edit"><i class="fa fa-edit"></i> Edit</button>
									<button id="{{$supplier->id}}" class="btn btn-danger btn_block btn-sm btn-block btn_delete"><i class="fa fa-trash"></i> Delete</button>
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
	        	<div class="form-group"><label>Name</label><input type="text" name="name" class="form-control " placeholder="Name" value="" ></div>
				<div class="form-group"><label>Contact</label><input type="number" value="" name="contact" class="form-control " placeholder="Contact" ></div>

				<div class="form-group"><label>Address</label><textarea class="form-control" cols="5" rows="5"  name="address" placeholder="Address"></textarea></div>
	        	
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
        $('input[name=contact]').val(data.contact);
        $('textarea[name=address]').val(data.address);
        $('#Modal').modal('show');
	    });

	// btn for inserting/updating data
	$(document).on('click','.btn_save',function(e){
		e.preventDefault();
		$('#form').find('.error_flash').remove();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/supplier';
		let patch = '/dashboard/supplier/'+id;
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
	                    url: '/dashboard/supplier/'+id,
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
		   	$( "#mytable" ).load( "/dashboard/supplier #mytable", function(){
			   $("#table").DataTable({
			   			            dom: 'lBfrtip'
			   			          });
			});
		}
</script>
@endsection