@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-right">
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
								<td>{{$patient->id}}</td>
								<td>{{$patient->name}}</td>
								<td>{{$patient->breed}}</td>
								<td>{{$patient->date_of_birth}}</td>
								<td>{{$patient->specie}}</td>
								<td>{{$patient->gender}}</td>
								<td  onclick="window.location = '/dashboard/client/{{$patient->client->id}}/patient';"><span class="text-primary">{{$patient->client->name}}</span></td>
								<td width="15%">
									<a href="/dashboard/patient/{{$patient->id}}/edit" class="btn btn-success btn-sm mr-1"><i class="fa fa-calendar"></i> &nbsp;View Details</a>
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