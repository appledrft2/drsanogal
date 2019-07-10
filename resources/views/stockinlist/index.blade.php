@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/suppliers" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/suppliers/search">
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
						<th>Name</th>
						<th>Contact</th>
						<th>Address</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($suppliers))
						@foreach($suppliers as $supplier)
							<tr>
								<td onclick="window.location = '/dashboard/suppliers/{{$supplier->id}}/stockin';">{{$supplier->name}}</td>
								<td onclick="window.location = '/dashboard/suppliers/{{$supplier->id}}/stockin';">{{$supplier->contact}}</td>
								<td onclick="window.location = '/dashboard/suppliers/{{$supplier->id}}/stockin';">{!!$supplier->address!!}</td>
								
								<td width="20%">
									<a href="/dashboard/suppliers/{{$supplier->id}}/stockin" class="btn btn-success btn-sm mr-1"><i class="fa fa-truck"></i> &nbsp;Select Supplier</a>
								</td>
							</tr>
						@endforeach
					@else
					<tr><td colspan="8" class="text-center">No Data</td></tr>
					@endif
				</tbody>
			</table>
			</div>
			<div class="float-right mt-1">{{ $suppliers->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection