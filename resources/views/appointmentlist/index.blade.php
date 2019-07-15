@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

<!-- 			<div class="float-right">
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
				
			</div> -->
			<div class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th width="10%">Patient ID</th>
						<th>Name</th>
						<th>Appointment</th>
						<th>Next Appointment</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Payment</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($appointments))
						@foreach($appointments as $appointment)
							<tr>
								<td>{{$appointment->patient->id}}</td>
								<td>{{$appointment->patient->name}}</td>
								<td>{{$appointment->appointment}}</td>
								<td>{{date('M d, Y', strtotime($appointment->date_to))}}</td>
								<td>&#8369; {{number_format($appointment->amount,2)}}</td>
								<td>
									@if($appointment->isCompleted == 'Completed')<span class="badge badge-success">Completed</span> 
									@elseif($appointment->isCompleted == 'Not Completed') <span class="badge badge-secondary">Not Completed</span> 
									@elseif($appointment->isCompleted == 'Rescheduled') <span class="badge badge-primary">Rescheduled</span> 
									@endif
								</td>
								<td>
									@if($appointment->isPaid != '') <span class="badge badge-success">Paid</span> 
									@else <span class="badge badge-secondary">Unpaid</span> 
									@endif
								</td>
								<td>
								<form method="POST" action="/dashboard/appointmentlist/{{$appointment->id}}">
			                      @method('PATCH')
			                      @csrf
			                      <select  onchange="this.form.submit()" class="form-control" name="isPaid">

										<option @if($appointment->isPaid == 0) selected @endif value="0" >Unpaid</option>
										<option  @if($appointment->isPaid == 1) selected @endif value="1" >Paid</option>
									</select>
			                    </form>
								</td>
							</tr>
						@endforeach
					@else
				<!-- 	<tr><td colspan="8" class="text-center">No Data</td></tr> -->
					@endif
				</tbody>
			</table>
			</div>

		</div>
	</div>
@endsection