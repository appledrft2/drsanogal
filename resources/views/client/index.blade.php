@extends('layouts.app')
@section('title',$title)
@section('content')

@if($errors->any())
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">{{$error}}</div>
	@endforeach
@endif

@if(session('success'))
		<div class="alert alert-success">{{session('success')}}</div>
@endif

	<div class="card">
		<div class="card-body">

			<div class="float-right">
				<form method="POST" action="/dashboard/client/search">
					@csrf
					<div class="input-group ">
					  <input type="text" class="form-control form-control-sm" name="data" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
					  <div class="input-group-append">
					    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
					  </div>
					</div>
				</form>
				
			</div>
			<div class="pull-left">
				<a href="/dashboard/client/create" class="btn btn-default btn-lg"><i class="fa fa-plus-circle"></i></a>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Gender</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
	<!-- 				<tr>
						<td><form method="POST" action="/dashboard/client/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by name"></form></td>
						<td><form method="POST" action="/dashboard/client/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by gender"></form></td>
						<td><form method="POST" action="/dashboard/client/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by contact"></form></td>
						<td><form method="POST" action="/dashboard/client/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by address"></form></td>
						<td></td>
					</tr> -->
					@if(count($clients))
						@foreach($clients as $client)
							<tr>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';">{{$client->name}}</td>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';">{{$client->gender}}</td>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';">{{$client->contact}}</td>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';">{{$client->address}}</td>
								<td width="15%">
									<div class="form-inline">
										<a href="/dashboard/client/{{$client->id}}/patient" class="btn btn-success btn-sm mr-1"><i class="fa fa-paw"></i></a>
										<a href="/dashboard/client/{{$client->id}}/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
										<form onsubmit="return confirm('Do you want to delete this record?');" method="POST" action="/dashboard/client/{{$client->id}}">
											@method('delete')
											@csrf
											<button class="btn btn-danger btn-sm mt-3"><i class="fa fa-trash"></i></button>
										</form>
									</div>
								</td>
							</tr>
						@endforeach
					@else
					<tr><td colspan="5" class="text-center">No Data</td></tr>
					@endif
				</tbody>
			</table>
			<div class="float-right mt-1">{{ $clients->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection