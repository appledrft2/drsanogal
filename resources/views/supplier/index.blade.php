@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">

			<div class="float-right">
				<div class="form-inline">
					@if(isset($btn)) <a href="/dashboard/supplier" class="btn btn-default mb-3 mr-2"><i class="fa fa-arrow-left"></i></a> @endif
					<form method="POST" action="/dashboard/supplier/search">
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
				<a href="/dashboard/supplier/create" class="btn btn-default btn-lg"><i class="fa fa-plus-circle"></i></a>
			</div>
			<div class="table-responsive">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Contact</th>
						<th>Address</th>
						<th width="20%">Products in stock</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@if(count($suppliers))
						@foreach($suppliers as $supplier)
							<tr>
								<td onclick="window.location = '/dashboard/supplier/{{$supplier->id}}/edit';">{{$supplier->name}}</td>
								<td onclick="window.location = '/dashboard/supplier/{{$supplier->id}}/edit';">{{$supplier->contact}}</td>
								<td onclick="window.location = '/dashboard/supplier/{{$supplier->id}}/edit';">{!!$supplier->address!!}</td>
								<th><form method="post" action="/dashboard/product/search">@csrf<input type="hidden" name="data" value="{{$supplier->id}}"><button class="btn btn-link">{{$supplier->products->count()}}</button></form></th>
								<td width="15%">
									<div class="form-inline">
										
										<a href="/dashboard/supplier/{{$supplier->id}}/edit" class="btn btn-info btn-sm mr-1"><i class="fa fa-edit"></i></a>
										<form  method="POST" action="/dashboard/supplier/{{$supplier->id}}">
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
			</div>
			<div class="float-right mt-1">{{ $suppliers->appends(Request::all())->links() }} </div>
		</div>
	</div>
@endsection