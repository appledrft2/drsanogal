@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/supplier" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">New Supplier</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/supplier">
				@csrf
				<div class="form-group"><label>Name</label><input type="text" name="name" class="form-control " placeholder="Name" value="{{old('name')}}" ></div>
				<div class="form-group"><label>Contact</label><input type="number" value="{{old('contact')}}" name="contact" class="form-control " placeholder="Contact" ></div>

				<div class="form-group"><label>Address</label><textarea class="form-control textarea"  name="address" placeholder="Address"></textarea>{{old('address')}}</div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection