@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/product" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">New Product</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/product" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<select  name="supplier_id" class="form-control ">
					<option value="">Supplier</option>
						@foreach($suppliers as $supplier)
						<option value="{{$supplier->id}}">{{$supplier->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Name" value="{{old('name')}}" ></div>
				<div class="form-group">
					<select  name="category" class="form-control ">
					<option value="">Category</option>
					@foreach($category as $cat)
						<option @if(old('category')=='{{$cat->title}}') selected @endif>{{$cat->title}}</option>

					@endforeach
					</select>
				</div>
				<div class="form-group">
					<select  name="unit" class="form-control ">
					<option value="">Unit</option>
					@foreach($units as $unit)
					<option @if(old('unit')=='{{$unit->title}}') selected @endif>{{$unit->title}}</option>
					@endforeach
					</select>
				</div>
				<div class="form-group"><input type="text" value="{{old('original')}}" name="original" class="form-control " placeholder="Original price" ></div>
				<div class="form-group"><input type="text" value="{{old('price')}}" name="price" class="form-control " placeholder="Selling price" ></div>
				<div class="form-group"><input type="number" value="{{old('quantity')}}" name="quantity" class="form-control " placeholder="Quantity" ></div>
				<div class="form-group"><input type="number" value="{{old('lowstock')}}" name="lowstock" class="form-control " placeholder="Low Stock" ></div>
				<div class="form-group">
					<input type="file" name="image" class="form-control-file mb-5" accept="image/*">
				</div> 
				
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection