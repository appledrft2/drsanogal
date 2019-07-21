@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
			<table id="table" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Gender</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($clients as $key => $client)
						<tr>
							<td>{{$key + 1}}</td>
							<td>{{$client->name}}</td>
							<td>{{$client->gender}}</td>
							<td>{{str_limit($client->address, 15)}}</td>
							
							<td><center><a href="/dashboard/billing/{{$client->id}}/client" class="btn  btn-default"><i class="fa fa-check"></i> Select Client</a></center></td>
						</tr>
					@endforeach
				</tbody>
			</table>
			</div>

		</div>
	</div>
@endsection