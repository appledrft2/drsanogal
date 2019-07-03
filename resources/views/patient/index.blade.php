@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="form-group">
		<a href="/dashboard/client" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="card card-sm">
				<div class="card-header"><p class="lead">Owner Information</p></div>
				<div class="card-body">
					<div class="row">
						<div class="col-6">
							<div class="form-group">
								<label class="lead">Name:</label>
								<span class="lead">{{$client->name}}</span>
							</div>
							
							<div class="form-group">
								<label class="lead">Gender:</label>
								<span class="lead">{{$client->gender}}</span>
							</div>
							
							<div class="form-group">
								<label class="lead">Contact:</label>
								<span class="lead">{{$client->contact}}</span>
							</div>
							
							<div class="form-group">
								<div class="form-inline">
									<label class="mb-3 lead">Address:</label>&nbsp;
									<span class="lead">{!!$client->address!!}</span>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="float-right">
								<img src="@if($client->gender == 'Male') {{asset('adminlte3/dist/img/male.png')}} @else {{asset('adminlte3/dist/img/female.png')}} @endif" class="img-fluid" style="border-radius: 90%;width: 50%">
							</div>
						</div>
					</div>

				</div>
			</div>
		
		
			<div class="float-right">
				<form method="POST" action="/dashboard/client/{{$client->id}}/patient/search">
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
				<a href="/dashboard/client/{{$client->id}}/patient/create" class="btn btn-default btn-lg"><i class="fa fa-plus-circle"></i></a>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Breed</th>
						<th>Gender</th>
						<th>Specie</th>
						<th>Birthday</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
	<!-- 				<tr>
						<td><form method="POST" action="/dashboard/patient/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by name"></form></td>
						<td><form method="POST" action="/dashboard/patient/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by gender"></form></td>
						<td><form method="POST" action="/dashboard/patient/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by contact"></form></td>
						<td><form method="POST" action="/dashboard/patient/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by address"></form></td>
						<td></td>
					</tr> -->
					@if(count($patients))
						@foreach($patients as $patient)
							<tr>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/patient';">{{$patient->name}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/patient';">{{$patient->breed}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/patient';">{{$patient->gender}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/patient';">{{$patient->specie}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/patient';">{{$patient->date_of_birth}}</td>
								<td width="15%">
									<div class="form-inline">
										
										<a href="/dashboard/client/{{$client->id}}/patient/{{$patient->id}}/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
										<form onsubmit="return confirm('Do you want to delete this record?');" method="POST" action="/dashboard/client/{{$client->id}}/patient/{{$patient->id}}">
											@method('delete')
											@csrf
											<button class="btn btn-danger btn-sm mt-3"><i class="fa fa-trash"></i></button>
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
			<div class="float-right mt-1">{{ $patients->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection