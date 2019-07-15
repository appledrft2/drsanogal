@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group"><label></label>
		<a href="/dashboard/supplier" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">Update supplier</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/supplier/{{$supplier->id}}">
				@method('PUT')
				@csrf
				<div class="form-group"><label>Name</label><input type="text" name="name" class="form-control " placeholder="Name" value="{{$supplier->name}}" ></div>
				<div class="form-group"><label>Contact</label><input type="number" value="{{$supplier->contact}}" name="contact" class="form-control " placeholder="Contact" ></div>
				<div class="form-group"><label>Address</label><textarea class="form-control" id="article-ckeditor" name="address" placeholder="Address">{{$supplier->address}}</textarea></div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection