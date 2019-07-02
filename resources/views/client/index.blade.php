@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			
			<div class="float-right">
				<!-- <form method="POST">
					@csrf
					<div class="input-group ">
					  <input type="text" class="form-control" placeholder="Search by name" aria-label="Recipient's username" aria-describedby="basic-addon2">
					  <div class="input-group-append">
					    <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
					  </div>
					</div>
				</form> -->
				<nav aria-label="Page navigation example">
				  <ul class="pagination">
				    <li class="page-item"><a class="page-link text-dark" href="#">Previous</a></li>
				    <li class="page-item"><a class="page-link text-dark" href="#">1</a></li>
				    <li class="page-item"><a class="page-link text-dark" href="#">2</a></li>
				    <li class="page-item"><a class="page-link text-dark" href="#">3</a></li>
				    <li class="page-item"><a class="page-link text-dark" href="#">Next</a></li>
				  </ul>
				</nav>
			</div>
			<div class="pull-left">
				<div class="form-inline">
					<form method="POST" action="/dashboard/client/create">
						@csrf
						<div class="mr-1"><input type="text" class="form-control form-control-sm" placeholder="Name" name=""></div>
						<div class="mr-1">
							<select class="form-control form-control-sm">
							<option value="">Gender</option>
							<option>Male</option>
							<option>Female</option>
							</select>
						</div>
						<div class="mr-1"><input type="number" class="form-control form-control-sm" placeholder="Contact" name=""></div>
						<div class="mr-1"><input type="text" class="form-control form-control-sm" placeholder="Address" name=""></div>
						<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i></button>
					</form>
				</div>
				
			</div>
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Gender</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><form><input type="text" name="" class="form-control form-control-sm" placeholder="Search by name"></form></td>
						<td><form><input type="text" name="" class="form-control form-control-sm" placeholder="Search by gender"></form></td>
						<td><form><input type="text" name="" class="form-control form-control-sm" placeholder="Search by contact"></form></td>
						<td><form><input type="text" name="" class="form-control form-control-sm" placeholder="Search by address"></form></td>
						<td></td>
					</tr>
					<tr >
						<td onclick="window.location = '/dashboard/client/1/patient';">Ragie Doromal</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">Male</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">09151535150</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">Brgy.Escalante</td>
						<td width="15%">
							<div class="form-inline">
								<a href="/dashboard/client/1/patient" class="btn btn-success btn-sm mr-1"><i class="fa fa-paw"></i></a>
								<a href="/dashboard/client/1/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
								<form onsubmit="return confirm('Do you want to delete this record?');" method="POST" action="/dashboard/client/1/delete">
									@method('delete')
									@csrf
									<button class="btn btn-danger btn-sm mt-3"><i class="fa fa-trash"></i></button>
								</form>
							</div>
						</td>
					</tr>
					<tr >
						<td onclick="window.location = '/dashboard/client/1/patient';">Ragie Doromal</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">Male</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">09151535150</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">Brgy.Escalante</td>
						<td width="15%">
							<div class="form-inline">
								<a href="/dashboard/client/1/patient" class="btn btn-success btn-sm mr-1"><i class="fa fa-paw"></i></a>
								<a href="/dashboard/client/1/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
								<form onsubmit="return confirm('Do you want to delete this record?');" method="POST" action="/dashboard/client/1/delete">
									@method('delete')
									@csrf
									<button class="btn btn-danger btn-sm mt-3"><i class="fa fa-trash"></i></button>
								</form>
							</div>
						</td>
					</tr>
					<tr >
						<td onclick="window.location = '/dashboard/client/1/patient';">Ragie Doromal</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">Male</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">09151535150</td>
						<td onclick="window.location = '/dashboard/client/1/patient';">Brgy.Escalante</td>
						<td width="15%">
							<div class="form-inline">
								<a href="/dashboard/client/1/patient" class="btn btn-success btn-sm mr-1"><i class="fa fa-paw"></i></a>
								<a href="/dashboard/client/1/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
								<form onsubmit="return confirm('Do you want to delete this record?');" method="POST" action="/dashboard/client/1/delete">
									@method('delete')
									@csrf
									<button class="btn btn-danger btn-sm mt-3"><i class="fa fa-trash"></i></button>
								</form>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
@endsection