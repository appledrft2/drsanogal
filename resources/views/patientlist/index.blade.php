@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/patient" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/patient/search">
						@csrf
						<div class="input-group ">
						  <input type="text" class="form-control form-control-sm" name="data" placeholder="Search" aria-label="Recipient's username" aria-describedby="basic-addon2">
						  <div class="input-group-append">
						    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
						  </div>
						</div>
					</form>
				</div>
				
			</div>

			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Patient ID</th>
						<th>Name</th>
						<th>Breed</th>
						<th>Birthday</th>
						<th>Specie</th>
						<th>Gender</th>
						<th>Owner</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($patients))
						@foreach($patients as $patient)
							<tr>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->id}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->name}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->breed}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->date_of_birth}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->specie}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->gender}}</td>
								<td  onclick="window.location = '/dashboard/client/{{$patient->client->id}}/patient';"><span class="text-primary">{{$patient->client->name}}</span></td>
								<td width="15%">
									<a href="/dashboard/patient/{{$patient->id}}/appointment" class="btn btn-success btn-sm mr-1"><i class="fa fa-calendar"></i> &nbsp;View Details</a>
								</td>
							</tr>
						@endforeach
					@else
					<tr><td colspan="8" class="text-center">No Data</td></tr>
					@endif
				</tbody>
			</table>
			<div class="float-right mt-1">{{ $patients->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection