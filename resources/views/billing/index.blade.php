@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="card">
				<div class="card-header"><p class="lead float-left">Owner Information</p> <span class="float-right"><a href="/dashboard/billing" class="btn btn-default">Go Back</a></span></div>
				<div class="card-body">
					<div class="row">
						<div class="col-6 " >
							<div class=" ">
								<label class="lead text-sm ">Name:</label>
								<span class="lead text-sm">{{$client->name}}</span>
							</div>
							
							<div class="">
								<label class="lead text-sm">Gender:</label>
								<span class="lead text-sm">{{$client->gender}}</span>
							</div>
							
							<div class="">
								<label class="lead text-sm">Contact:</label>
								<span class="lead text-sm">{{$client->contact}}</span>
							</div>
							
							<div class="">
								<div class="form-inline">
									<label class="mb-3 lead text-sm">Address:</label>&nbsp;
									<span class="lead text-sm">{!!$client->address!!}</span>
								</div>
							</div>
						</div>
						<div class="col-6">
							<div class="float-right">
								<img src="@if($client->gender == 'Male') {{asset('adminlte3/dist/img/male.png')}} @else {{asset('adminlte3/dist/img/female.png')}} @endif" class="img-fluid" style="border-radius: 90%;width: 30%">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="pull-left mb-3">
				<a href="/dashboard/billing/{{$client->id}}/client/create" class="btn btn-default btn_add"><i class="fa fa-plus-circle"></i> New Transaction</a>
			</div>
			<div class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Receipt #</th>
						<th>Amount</th>
						<th>Transaction Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				
						@foreach($billings as $key => $billing)
							<tr>
								<td>{{$key + 1}}</td>
								<td>{{$billing->rcode}}</td>
								<td>{{$billing->amount}}</td>
								<td>{{$billing->created_at->diffForhumans()}}</td>
								<td width="25%">
									<div class="form-inline">
										<a href="/dashboard/billing/{{$billing->rcode}}/receipt" class="btn btn-info btn-sm"><i class="fa fa-print"></i> View Receipt</a>
										<form  method="POST" action="/dashboard/billing/{{$client->id}}/client/{{$billing->id}}">
												@method('delete')
												@csrf
												<button class="btn btn-danger btn-sm  ml-3 mt-3 btn-submit"><i class="fa fa-trash"></i> Delete Bill</button>
											</form></td>
									</div>
							</tr>
						@endforeach
				
				</tbody>
			</table>
			</div>

		</div>
	</div>
@endsection