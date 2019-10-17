@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
			<table id="servicelist" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Client Name</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>

					@foreach($clients as $key => $client)
						<tr>
							<td>{{$key + 1}}</td>
							<td>{{$client->name}}</td>
							<td>{{$client->address}}</td>
							
							
							<td><center><a href="/dashboard/billing/{{$client->id}}/client" class="btn  btn-default btn-sm"><i class="fa fa-credit-card"></i>&nbsp; Manage billing</a></center></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			</div>

		</div>
	</div>
@endsection