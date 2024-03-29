@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/product" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">Update Product</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/product/{{$product->id}}" enctype="multipart/form-data">
				@method('PATCH')
				@csrf
				<div class="form-group">
					<select  name="supplier_id" class="form-control ">
					<option value="">Supplier</option>
						@foreach($suppliers as $supplier)
						<option @if($product->supplier_id == $supplier->id) selected @endif value="{{$supplier->id}}">{{$supplier->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Name" value="{{$product->name}}" ></div>
				<div class="form-group">
					<select  name="category" class="form-control ">
					<option value="">Category</option>
					<option @if($product->category =='Dog Food') selected @endif>Dog Food</option>
					<option @if($product->category =='Cat Food') selected @endif>Cat Food</option>
					<option @if($product->category =='Medicine') selected @endif>Medicine</option>
					<option @if($product->category =='Other') selected @endif>Other</option>
					</select>
				</div>
				<div class="form-group">
					<select  name="unit" class="form-control ">
					<option value="">Unit</option>
					<option @if($product->unit=='pc') selected @endif>pc</option>
					<option @if($product->unit=='kg') selected @endif>kg</option>
					<option @if($product->unit=='bottle') selected @endif>bottle</option>
					<option @if($product->unit=='tab') selected @endif>tab</option>
					<option @if($product->unit=='Other') selected @endif>Other</option>
					</select>
				</div>
				<div class="form-group"><input type="text" value="{{$product->original}}" name="original" class="form-control " placeholder="Original price" ></div>
				<div class="form-group"><input type="text" value="{{$product->price}}" name="price" class="form-control " placeholder="Selling price" ></div>
				<div class="form-group"><input type="number" value="{{$product->quantity}}" name="quantity" class="form-control " placeholder="Quantity" ></div>
				<div class="form-group"><input type="number" value="{{$product->lowstock}}" name="lowstock" class="form-control " placeholder="Low Stock" ></div>
				<div class="form-group">
					<img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$product->image}}" class="img-fluid rounded" style="width: 200px;height:100px">
				</div> 
				<div class="form-group">
					<input type="file" name="image" class="form-control-file mb-5" accept="image/*">
				</div> 

				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection