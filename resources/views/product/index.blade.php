@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-left mb-3">
				<buttond class="btn btn_add btn-default "><i class="fa fa-plus-circle"></i>New Product</button>
			</div>
			<!-- <div class="float-right mb-3">
				@isset($btn)
				<a href="/dashboard/product" class="btn btn-secondary ">{{$btn->name}} <i class="fa fa-times"></i> </a>
				@endisset
				<a href="/dashboard/productunit" class="btn btn-default "><i class="fa fa-balance-scale"></i> Unit</a>
				<a href="/dashboard/productcategory" class="btn btn-default "><i class="fa fa-tags"></i> Categories</a>
			</div> -->
			<div id="mytable" class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
					
						<th>Supplier</th>
						<th>Name</th>
						<th>Category</th>
						<th>Unit</th>
						<th>Original</th>
						<th>Selling</th>
						<th>Quantity</th>
						<th width="15%" >Sub Total</th>
						<th >Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($products))
					<?php $i=1;$sumprod=0; ?>
						@foreach($products as $product)
							<?php $sumprod = $sumprod + ($product->quantity * $product->price); ?>
							<tr>
				
								<td><a href="/dashboard/supplier/{{$product->supplier->id}}/edit">{{$product->supplier->name}}</a></td>
								<td>{{$product->name}}</td>
								<td>{{$product->category}}</td>
								<td>{{$product->unit}}</td>
								<td class="text-right">&#8369; {{number_format($product->original,2)}}</td>
								<td class="text-right">&#8369; {{number_format($product->price,2)}}</td>
								<td>{{$product->quantity}}</td>
								<td class="text-right">&#8369; {{number_format($product->quantity * $product->price,2)}}</td>
								
								<td width="15%" >
									<div class="form-inline">		
										<button style="margin: 1px" id="{{$product}}" class="btn btn-info btn_edit btn-sm " title="Edit"><i class="fa fa-edit"></i></button>
										<button style="margin: 1px" id="{{$product->id}}" class="btn btn-danger btn-sm btn_delete" title="Delete"><i class="fa fa-trash"></i></button>
										
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
	        		<!-- <select  name="supplier_id" class="form-control ">
	        		<option value="">Supplier</option>
	        			@foreach($suppliers as $supplier)
	        			<option value="">{{$supplier->name}}</option>
	        			@endforeach
	        		</select> -->
	        		<select id="supplier_id" name="supplier_id" class="form-control select2" style="width: 100%;">
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
	        		<option value="{{$supplier->id}}">{{$supplier->name}}</option>
	        		@endforeach
                  </select>

	        	</div>
	        	<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Product name" value="" ></div>
	        	<div class="form-group">
	        		<!-- <select  name="category" class="form-control ">
	        		<option value="">Category</option>
	        		@foreach($category as $cat)
	        			<option>{{$cat->title}}</option>

	        		@endforeach
	        		</select> -->
	        		<select name="category" class="form-control select2" style="width: 100%;">
                    <option value="">Select Category</option>
                    @foreach($category as $cat)
	        		<option>{{$cat->title}}</option>
	        		@endforeach
	        		<option>Other</option>
                  </select>
	        	</div>
	        	<div class="form-group">
	        	<!-- 	<select  name="unit" class="form-control ">
	        		<option value="">Unit</option>
	        		@foreach($units as $unit)
	        		<option>{{$unit->title}}</option>
	        		@endforeach
	        		</select> -->

      
                  <select name="unit" class="form-control select2" style="width: 100%;">
                    <option value="">Select Unit</option>
                    @foreach($units as $unit)
	        		<option>{{$unit->title}}</option>
	        		@endforeach
	        		<option>Other</option>
                  </select>
	        	</div>
	        	<!-- <div class="form-group"><input type="text" value="" name="original" class="form-control " placeholder="Original price" ></div>
	        	<div class="form-group"><input type="text" value="" name="price" class="form-control " placeholder="Selling price" ></div> -->
	        	<div class="form-group">
		        	<div class="input-group mb-1">
	                  <div class="input-group-prepend">
	                    <span class="input-group-text">&#8369;</span>
	                  </div>
	                  <input placeholder="Original price" name="original" type="text" class="form-control">
	                </div>
	        	</div>
               <div class="form-group">
	               	<div class="input-group mb-1">
	               	  <div class="input-group-prepend">
	               	    <span class="input-group-text">&#8369;</span>
	               	  </div>
	               	  <input placeholder="Selling price" name="price" type="text" class="form-control">
	               	</div>
               </div>
	        	<div class="form-group"><input type="number" value="" name="quantity" class="form-control " placeholder="Quantity" ></div>
	        	<div class="form-group"><input type="number" value="" name="lowstock" class="form-control " placeholder="Low Stock" ></div>
	        	<div class="form-group">
	        		<!-- label>Attach an image (optional)</label>
	        		<input type="file" name="image" class="form-control-file mb-5" accept="image/*"> -->

		               <label for="exampleInputFile">Attach an image (optional) </label>
		               <div class="form-group">
		               		<div id="img"></div>
		               </div>
		               <div class="input-group">
		                 <div class="custom-file">
		                   <input type="file" name="image" accept="image/*" class="custom-file-input" id="exampleInputFile">
		                   <label class="custom-file-label" for="exampleInputFile">Choose file</label>
		                 </div>
		             
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
		let data = $(this).attr('id');
		data = JSON.parse(data);
		var id = data.id;
		$('input[name=id]').val(id);
		$('input[name=_method]').val('PATCH');
		$('.modal-title').text('Update');
		

        $('select[name=supplier_id]').val(data.supplier_id);
        $('input[name=name]').val(data.name);
        $('select[name=category').val(data.category);
        $('select[name=unit').val(data.unit);
        $('input[name=original]').val(data.original);
        $('input[name=price]').val(data.price);
        $('input[name=quantity]').val(data.quantity);
        $('input[name=lowstock]').val(data.lowstock);
        $('.select2').trigger('change');
        $('#img').append('<img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/'+data.image+'" width="20%">');
        $('#Modal').modal('show');
  
		
	});
	// btn for inserting/updating data
	$('#form').on('submit',function(e){
		e.preventDefault();
		$('#form').find('.error_flash').remove();
		let method = $('input[name=_method]').val();
		let id = $('input[name=id]').val();
		let post = '/dashboard/product';
		let patch = '/dashboard/product/'+id;
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
	                el.after($('<span class="col-md-12 error_flash" style="color: red;">'+error[0]+'</span>'));
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
                url: '/dashboard/product/'+id,
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
	   	$( "#mytable" ).load( "/dashboard/product #mytable", function(){
		   $("#table").DataTable({
		   			            dom: 'lBfrtip'
		   			          });
		});
	}
</script>
@endsection
