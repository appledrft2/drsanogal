@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/account" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">Edit Account</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-6">
					<form  method="POST" action="/dashboard/account/{{$user->id}}">
						@method('PATCH')
						@csrf
						<div class="form-group"><input type="text" name="name" class="form-control " placeholder="Name" value="{{$user->name}}" ></div>
						<div class="form-group"><input type="email" name="email" class="form-control " placeholder="Email" value="{{$user->email}}" ></div>
						<div class="form-group">
							<select  name="role" class="form-control ">
							<option value="">Role</option>
							<option @if($user->role =='doctor') selected @endif value="doctor">Doctor</option>
							<option @if($user->role =='staff') selected @endif value="staff">Staff</option>
							</select>
						</div>
						<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
					</form>
				</div>
				<div class="col-md-6">
					<div class='alert alert-info' role='alert'><i class='fa fa-key'></i> Leave the password field empty if you don't want to change.</div>
					<form  class="" method="POST" action="/dashboard/account/{{$user->id}}/password">
						@method('PATCH')
						@csrf
						<div class="form-group"><input type="password" value="" name="password" class="form-control " placeholder="Password" ></div>
						<div class="form-group"><input type="password" value="" name="password_confirmation" class="form-control " placeholder="Retype Password" ></div>
						<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
					</form>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection