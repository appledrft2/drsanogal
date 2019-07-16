@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/client" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">New Client</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/client">
				@csrf
				<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Name" value="{{old('name')}}" ></div>
				<div class="form-group">
					<select  name="gender" class="form-control ">
					<option value="">Gender</option>
					<option @if(old('gender')=='Male') selected @endif>Male</option>
					<option @if(old('gender')=='Female') selected @endif>Female</option>
					</select>
				</div>
				<div class="form-group"><input type="text" name="occupation" class="form-control " placeholder="Occupation" value="{{old('occupation')}}" ></div>
				<div class="form-group ">
					<label>Contact Numbers</label>
					<div class="row">
						<div class="form-group col-4"><input type="number" value="{{old('contact')}}" name="contact" class="form-control " placeholder="Mobile" ></div>	
						<div class="form-group col-4"><input type="number" value="{{old('work')}}" name="work" class="form-control " placeholder="Work" ></div>
						<div class="form-group col-4"><input type="number" value="{{old('home')}}" name="home" class="form-control " placeholder="Home" ></div>	
						<div class="form-group col-12">
							<select name="smsNotify" class="form-control">
								<option value="">Which number to notify</option>
								<option @if(old('smsNotify')=='Mobile') selected @endif>Mobile</option>
								<option @if(old('smsNotify')=='Home') selected @endif>Home</option>
								<option @if(old('smsNotify')=='Work') selected @endif>Work</option>
								<option @if(old('smsNotify')=='None') selected @endif>None</option>
							</select>
					</div>
				</div>
				<hr>	
				<div class="form-group"><input type="email" value="{{old('email')}}" name="email" class="form-control " placeholder="Email Address" ></div>	
				<div class="form-group">
					<label>Address</label>
					<textarea class="form-control textarea" name="address" placeholder="Address">{{old('address')}}</textarea></div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection