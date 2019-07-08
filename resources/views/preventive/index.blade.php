@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="card">
		<div class="card-body">
			<div class="card card-sm">
				<div class="card-header"><p class="lead float-left">Appointment Information</p> <span class="float-right"><a href="/dashboard/patient/{{$appointment->patient->id}}/appointment" class="btn btn-default">Go Back</a></span></div>
				<div class="card-body">
					<div class="row">
						<div class="col-8">
							<div class="form-group">
								<label style="font-size:18" class="lead">Patient:</label>
								<span class="lead">{{$appointment->patient->name}}</span>
							</div>
							<div class="form-group">
								<label style="font-size:18" class="lead">Description:</label>
								<span class="lead">{!!$appointment->description!!}</span>
							</div>

							<div class="form-group">
								<label style="font-size:18" class="lead">Date Visited:</label>
								<span class="lead">{{date('M d, Y', strtotime($appointment->date_from))}}</span>
							</div>

							<div class="form-group">
								<label style="font-size:18" class="lead">Next Appointment:</label>
								<span class="lead">{{date('M d, Y', strtotime($appointment->date_to))}}</span>
							</div>
							
							<div class="form-group">
								<label style="font-size:18" class="lead">Status:</label>
								<span class="lead">@if($appointment->status == null) Not Completed @else {{$appointment->status}} @endif</span>
							</div>
							<div class="form-group">
								<label style="font-size:18" class="lead">Owner notified? :</label>
								<span class="lead">@if($appointment->isNotified == 1) <span class="badge badge-success">Owner is notified</span> @else <span class="badge badge-secondary">Waiting for the day of appointment</span>  @endif</span>
							</div>
							
							
						</div>
					
						<div class="col-4">
							<br><br><br>
							<div class="form-group">
								<div style="font-size:10.5em">
									<i class="fa fa-calendar-alt"></i>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		
		
			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/appointment/{{$appointment->id}}/preventive" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/appointment/{{$appointment->id}}/preventive/search">
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
			<div class="pull-left">
				<a href="/dashboard/appointment/{{$appointment->id}}/preventive/create" class="btn btn-default btn-lg"><i class="fa fa-plus-circle"></i></a>
			</div>	
			<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Type</th>
						<th>Time</th>
						<th>Kg</th>
						<th>Temp</th>
						<th>Description</th>
						<th>Price</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
	<!-- 				<tr>
						<td><form method="POST" action="/dashboard/appointment/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by name"></form></td>
						<td><form method="POST" action="/dashboard/appointment/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by gender"></form></td>
						<td><form method="POST" action="/dashboard/appointment/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by contact"></form></td>
						<td><form method="POST" action="/dashboard/appointment/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by address"></form></td>
						<td></td>
					</tr> -->
					@if(count($preventives))
						@foreach($preventives as $preventive)
							<tr>
								<td>{{$preventive->type}}</td>
								<td>{{$preventive->time}}</td>
								<td>{{$preventive->kg}}</td>
								<td>{{$preventive->temp}}</td>
								<td>{!! $preventive->description !!}</td>
								<td>{{number_format($preventive->price,2)}}</td>
								<td>@if($preventive->status == 'Paid') <span class="badge badge-success">{{$preventive->status}}</span>@else <span class="badge badge-secondary">Unpaid</span>@endif</td>
								<td width="15%">
									<div class="form-inline">
										<a href="/dashboard/appointment/{{$appointment->id}}/preventive/{{$preventive->id}}/edit" class="btn btn-block btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
										<form method="POST" action="/dashboard/appointment/{{$appointment->id}}/preventive/{{$preventive->id}}" style="width:98%">
											@method('delete')
											@csrf
											<button class="btn btn-block btn-danger btn-sm mt-3 btn-submit"><i class="fa fa-trash"></i></button>
										</form>
									</div>
								</td>
							</tr>
						@endforeach
					@else
					<tr><td colspan="10" class="text-center">No Data</td></tr>
					@endif
				</tbody>
			</table>
			</div>
			<div class="float-right mt-1">{{ $preventives->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection