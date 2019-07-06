@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/account" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/account/search">
						@csrf
						<div class="input-group ">
						  <input type="text" class="form-control form-control-sm" name="data" placeholder="Search" aria-label="Recipient's accountname" aria-describedby="basic-addon2">
						  <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
						  </div>
						</div>
					</form>
				</div>
				
			</div>
			<div class="pull-left">
				<a href="/dashboard/account/create" class="btn btn-default btn-lg"><i class="fa fa-plus-circle"></i></a>
			</div>
			<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Avatar</th>
						<th>Name</th>
						<th>Email</th>
						<th>Role</th>
						<th width="10%">Posted Announcements</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
	<!-- 				<tr>
						<td><form method="POST" action="/dashboard/user/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by name"></form></td>
						<td><form method="POST" action="/dashboard/user/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by gender"></form></td>
						<td><form method="POST" action="/dashboard/user/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by contact"></form></td>
						<td><form method="POST" action="/dashboard/user/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by address"></form></td>
						<td></td>
					</tr> -->
					@if(count($users))
						@foreach($users as $user)
							<tr>
								<td onclick="window.location = '/dashboard/account/{{$user->id}}/edit';"><center><img src="@if($user->role == 'doctor') {{asset('adminlte3/dist/img/doctor.png')}} @else {{asset('adminlte3/dist/img/staff.png')}} @endif" class="elevation-1 img-fluid img-circle" alt="User Image" width="50px"></center></td>
								<td onclick="window.location = '/dashboard/account/{{$user->id}}/edit';">{{$user->name}}</td>
								<td onclick="window.location = '/dashboard/account/{{$user->id}}/edit';">{{$user->email}}</td>
								<td onclick="window.location = '/dashboard/account/{{$user->id}}/edit';">{{ucfirst($user->role)}}</td>
								<td onclick="window.location = '/dashboard/account/{{$user->id}}/edit';"><a href="/dashboard/announcement" class="text-bold">{{$user->announcements->count()}}</a></td>
								<td width="15%">
									<div class="form-inline">
										
										<a href="/dashboard/account/{{$user->id}}/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
										<form  method="POST" action="/dashboard/account/{{$user->id}}">
											@method('delete')
											@csrf
											<button class="btn btn-danger btn-sm mt-3 btn-submit"><i class="fa fa-trash"></i></button>
										</form>
									</div>
								</td>
							</tr>
						@endforeach
					@else
					<tr><td colspan="6" class="text-center">No Data</td></tr>
					@endif
				</tbody>
			</table>
			</div>
			<div class="float-right mt-1">{{ $users->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection