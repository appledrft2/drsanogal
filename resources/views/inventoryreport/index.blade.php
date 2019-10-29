@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card collapsed-card">
	  <div class="card-header">
	    <h4 >Generate Report</h4>
	    <div class="card-tools " >
	        <button type="button" class="btn btn-tool" data-widget="collapse">
	          <i class="fas fa-angle-down"></i>
	        </button>
	     </div>
	  </div>
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
							
              				<th width="15%">Quantity Sold</th>
						
							<th>Date</th>
              			
						</tr>
					</thead>
					<tbody>

						@if($stockouts)
						<?php $i=1; ?>
							@foreach($stockouts as $key => $test)
							
							 @foreach($test as $key2 => $ts)
							<tr>
							<td>{{$i++}}</td>
							 <td>{{$ts->name}}</td>
							
							 <td>{{$ts->quantity}}</td>
			
							 <td>{{date('M d, D Y', strtotime($ts->date))}}</td>
							</tr>
							 @endforeach
							

							@endforeach
						@endif
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

