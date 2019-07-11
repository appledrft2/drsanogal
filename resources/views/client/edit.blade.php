@extends('layouts.app')
@section('title',$title)

@section('content')

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
				<div class="form-group"><input type="text" name="occupation" class="form-control " placeholder="Occupation" value="{{$client->occupation}}" ></div>
				<div class="form-group ">
					<label>Contact Numbers</label>
					<div class="row">
						<div class="form-group col-4"><input type="number" value="{{$client->contact}}" name="contact" class="form-control " placeholder="Mobile" ></div>	
						<div class="form-group col-4"><input type="number" value="{{$client->work}}" name="work" class="form-control " placeholder="Work" ></div>
						<div class="form-group col-4"><input type="number" value="{{$client->home}}" name="home" class="form-control " placeholder="Home" ></div>	
						<div class="form-group col-12">
							<select name="smsNotify" class="form-control">
								<option value="">Which number to notify</option>
								<option @if($client->smsNotify=='Mobile') selected @endif>Mobile</option>
								<option @if($client->smsNotify=='Home') selected @endif>Home</option>
								<option @if($client->smsNotify=='Work') selected @endif>Work</option>
								<option @if($client->smsNotify=='None') selected @endif>None</option>
							</select>
					</div>
				</div>
				<hr>
				<div class="form-group"><input type="email" value="{{$client->email}}" name="email" class="form-control " placeholder="Email Address" ></div>		
				<div class="form-group"><textarea class="form-control" id="article-ckeditor" name="address" placeholder="Address">{{$client->address}}</textarea></div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection