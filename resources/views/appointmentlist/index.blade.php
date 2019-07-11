@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/appointment" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/appointment/search">
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
			<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Patient ID</th>
						<th>Name</th>
						<th>Date Visited</th>
						<th>Next Appointment</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($appointments))
						@foreach($appointments as $appointment)
							<tr>
								<td onclick="window.location = '/dashboard/appointment/{{$appointment->id}}/preventive';">{{$appointment->patient->id}}</td>
								<td onclick="window.location = '/dashboard/appointment/{{$appointment->id}}/preventive';">{{$appointment->patient->name}}</td>
								<td onclick="window.location = '/dashboard/appointment/{{$appointment->id}}/preventive';">{{date('M d, Y', strtotime($appointment->date_from))}}</td>
								<td onclick="window.location = '/dashboard/appointment/{{$appointment->id}}/preventive';">{{date('M d, Y', strtotime($appointment->date_to))}}</td>
								<td onclick="window.location = '/dashboard/appointment/{{$appointment->id}}/preventive';">{{$appointment->status}}</td>
			
								<td width="15%">
									<a href="/dashboard/appointment/{{$appointment->id}}/preventive" class="btn btn-success btn-sm mr-1"><i class="fa fa-calendar"></i> &nbsp;View Details</a>
								</td>
							</tr>
						@endforeach
					@else
					<tr><td colspan="8" class="text-center">No Data</td></tr>
					@endif
				</tbody>
			</table>
			</div>
			<div class="float-right mt-1">{{ $appointments->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection