@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<!-- <div class="float-right">
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
				
			</div> -->
			<div class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						
						<th>Name</th>
						<th>Breed</th>
						<th>Specie</th>
						<th>Gender</th>
						<th>Veterinarian</th>
						<th>Owner</th>
						@if(Auth::user()->role == 'doctor')
						<th>Action</th>
						@endif
					</tr>
				</thead>
				<tbody>
					@if(count($patients))
						@foreach($patients as $patient)
							<tr>
								
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->name}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->breed}}</td>
								
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->specie}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->gender}}</td>
								<td onclick="window.location = '/dashboard/patient/{{$patient->id}}/appointment';">{{$patient->veterinarian}}</td>
								<td  onclick="window.location = '/dashboard/client/{{$patient->client->id}}/patient';"><span class="text-primary">{{$patient->client->name}}</span></td>
								 @if(Auth::user()->role == 'doctor')
								<td width="20%">
									<center><a href="/dashboard/patient/{{$patient->id}}/appointment" class="btn btn-primary  btn-sm"><i class="fa fa-paw"></i> Pet Profile</a></center>
								</td>
								@endif
							</tr>
						@endforeach
					@else
					<!-- <tr><td colspan="8" class="text-center">No Data</td></tr> -->
					@endif
				</tbody>
			</table>
			</div>

		</div>
	</div>
@endsection