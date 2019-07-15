@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="card">
		<div class="card-body">
			<div class="card card-sm">
				<div class="card-header"><p class="lead float-left">Patient Information</p> <span class="float-right"><a href="/dashboard/patient" class="btn btn-default">Go Back</a></span></div>
				<div class="card-body">
					<div class="row">
						<div class="col-4">
							<div class="form-group">
								<label style="font-size:18" class="lead">Owner:</label>
								<span class="lead">{{$patient->client->name}}</span>
							</div>
							<div class="form-group">
								<label style="font-size:18" class="lead">Name:</label>
								<span class="lead">{{$patient->name}}</span>
							</div>

							<div class="form-group">
								<label style="font-size:18" class="lead">Breed:</label>
								<span class="lead">{{$patient->breed}}</span>
							</div>

							<div class="form-group">
								<label style="font-size:18" class="lead">Gender:</label>
								<span class="lead">{{$patient->gender}}</span>
							</div>
							
							<div class="form-group">
								<label style="font-size:18" class="lead">Specie:</label>
								<span class="lead">{{$patient->specie}}</span>
							</div>
							<div class="form-group">
								<label style="font-size:18" class="lead">Date of Birth:</label>
								<span class="lead">{{date('M d, Y', strtotime($patient->date_of_birth))}}</span>
							</div>
							
							
						</div>
						<div class="col-4">
							<div class="form-group">
								<label style="font-size:18" class=" lead">Markings:</label>
								<div class="form-group">
									<span class="lead">{{$patient->markings}}</span>
								</div>
							</div>
							
							<div class="form-group">
								<label style="font-size:18" class="lead">Special <br>Considerations:</label>
								<div class="form-group">
									<span class="lead">{{$patient->special_considerations}}</span>
								</div>
							</div>
							
							<div class="form-group">
								<label style="font-size:18" class="lead">Attending <br>Veterinarian:</label>
								<div class="form-group">
									
									<span class="lead">{{$patient->veterinarian}}</span>
								</div>
							</div>
							
							
						</div>
						<div class="col-4">
							<br><br><br>
							<div class="form-group">
								<img src="{{asset('adminlte3/dist/img/logo.jpg')}}" class="img-fluid" style="border-radius: 90%;width: 50%">
							</div>
						</div>
					</div>

				</div>
			</div>
		
		
		<!-- 	<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/patient/{{$patient->id}}/appointment" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/patient/{{$patient->id}}/appointment/search">
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
			<div class="pull-left mb-3">
				<a href="/dashboard/patient/{{$patient->id}}/appointment/create" class="btn btn-default "><i class="fa fa-plus-circle"></i> New Appointment</a>
			</div>	
			<div class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Appointment</th>
						<th>Next appointment</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Payment</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; ?>
					@if(count($appointments))
						@foreach($appointments as $appointment)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$appointment->appointment}}</td>
								<td>{{date('M d, D Y', strtotime($appointment->next_appointment))}}</td>
							
								<td>&#8369; {{number_format($appointment->amount,2)}}</td>
								<td>
									@if($appointment->isCompleted == 'Not Completed') <span class="badge badge-secondary">Not Completed</span> 
									@elseif($appointment->isCompleted == 'Completed') <span class="badge badge-success"> Completed</span>
									@elseif($appointment->isCompleted == 'Rescheduled') <span class="badge badge-primary"> Rescheduled</span> @endif
								</td>
								<td>
									@if($appointment->isPaid != '') <span class="badge badge-success">Paid</span> 
									@else <span class="badge badge-secondary">Unpaid</span> 
									@endif
								</td>
								<td>
									<a href="/dashboard/patient/{{$patient->id}}/appointment/{{$appointment->id}}/edit" class=" btn-sm btn btn-info btn-block"><i class="fa fa-edit"></i> Edit</a>

									<form method="POST" action="/dashboard/patient/{{$patient->id}}/appointment/{{$appointment->id}}" style="width:98%">
											@method('delete')
											@csrf
											<button class="btn btn-block btn-danger btn-sm mt-3 btn-submit"><i class="fa fa-trash"></i> Remove</button>
										</form>
								</td>
							</tr>
						@endforeach
					@else
					
					@endif
				</tbody>
			</table>
			</div>

		</div>
	</div>
@endsection