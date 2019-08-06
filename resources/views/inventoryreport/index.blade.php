@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<h4 class="card-header">Product Sold</h4>
		<div class="card-body">
			
			<div class="col-md-6 mx-auto">
				<form action="/dashboard/inventoryreport/generateReport" method="POST">
					@csrf
				<div class="form-group">
					<label>Date From</label>
					<input type="date" class="form-control" name="from">
					@if ($errors->has('from'))
					    <div class="text-danger">{{ $errors->first('from') }}</div>
					@endif
				</div>
				<div class="form-group">
					<label>Date To</label>
					<input type="date" class="form-control" name="to">
					@if ($errors->has('to'))
					    <div class="text-danger">{{ $errors->first('to') }}</div>
					@endif
				</div>
			</div>
		</div>
		<div class="card-footer">
			<span class="float-right"><button class="btn btn-primary"> Generate</button></span>
			</form>
		</div>
	</div>
	<div class="card">
    
		<div class="card-body">
     	
			<div class="table-responsive">
				<table id="table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Product Name</th>
							<th>Selling Price</th>
              				<th>Quantity</th>
							<th>Profit</th>
							<th>Date</th>
              			
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach($stockouts as $key1 => $stock)
							
							@foreach($stockouts as $key2 => $st)
							<tr>

								<td>{{$i++}}</td>
								<td>{{$stockouts[$key1][$key2]['name']}}</td>
								<td>{{$stockouts[$key1][$key2]['price']}}</td>
								<td>{{$stockouts[$key1][$key2]['quantity']}}</td>
								<td>{{$stockouts[$key1][$key2]['netamount']}}</td>
								<td>{{date('M d, D Y', strtotime($stockouts[$key1][$key2]['date']))}}</td>
							
							</tr>
						
							@endforeach

						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

