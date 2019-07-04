@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/client" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/client/search">
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
				<a href="/dashboard/client/create" class="btn btn-default btn-lg"><i class="fa fa-plus-circle"></i></a>
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Gender</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Pets</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
	<!-- 				<tr>
						<td><form method="POST" action="/dashboard/client/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by name"></form></td>
						<td><form method="POST" action="/dashboard/client/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by gender"></form></td>
						<td><form method="POST" action="/dashboard/client/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by contact"></form></td>
						<td><form method="POST" action="/dashboard/client/search">@csrf<input type="text" name="data" class="form-control form-control-sm" placeholder="Search by address"></form></td>
						<td></td>
					</tr> -->
					@if(count($clients))
						@foreach($clients as $client)
							<tr>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';">{{$client->name}}</td>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';">{{$client->gender}}</td>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';">{{$client->contact}}</td>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';">{!!$client->address!!}</td>
								<td onclick="window.location = '/dashboard/client/{{$client->id}}/patient';"><a href="/dashboard/client/{{$client->id}}/patient" class="text-bold">{{$client->patients->count()}}</a></td>
								<td width="15%">
									<div class="form-inline">
										
										<a href="/dashboard/client/{{$client->id}}/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
										<form  method="POST" action="/dashboard/client/{{$client->id}}">
											@method('delete')
											@csrf
											<button class="btn btn-danger btn-sm mt-3 btn-submit"><i class="fa fa-trash"></i></button>
										</form>
									</div>
								</td>
							</tr>
						@endforeach
					@else
					<tr><td colspan="6" class="text-center">No Data</td></tr>
					@endif
				</tbody>
			</table>
			<div class="float-right mt-1">{{ $clients->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection