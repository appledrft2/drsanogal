@extends('layouts.app')
@section('title',$title)

@section('content')

@if($errors->any())
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">{{$error}}</div>
	@endforeach
@endif
<div class="col-md-10 mx-auto">
	<div class="form-group">
		<button onclick="history.back()" class="btn btn-default">Go Back</button>
	</div>
	<div class="card">
		<div class="card-header">Update Client</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/client/{{$client->id}}">
				@method('PUT')
				@csrf
				<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Name" value="{{$client->name}}" ></div>
				<div class="form-group">
					<select  name="gender" class="form-control ">
					<option value="">Gender</option>
					<option @if($client->gender =='Male') selected @endif>Male</option>
					<option @if($client->gender =='Female') selected @endif>Female</option>
					</select>
				</div>
				<div class="form-group"><input type="number" value="{{$client->contact}}" name="contact" class="form-control " placeholder="Contact" ></div>
				<div class="form-group"><textarea class="form-control" name="address" placeholder="Address">{{$client->address}}</textarea></div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection