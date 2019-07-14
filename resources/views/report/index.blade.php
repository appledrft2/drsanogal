@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Receipt No.</th>
							<th>Amount</th>
							<th>Transaction Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach($reports as $report)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$report->rcode}}</td>
								<td>&#8369; {{number_format($report->amount,2)}}</td>
								<td>{{$report->created_at->diffForhumans()}}</td>
								<td>
									<a href="receipt/{{$report->rcode}}" class="btn btn-default btn-sm"><i class="fa fa-list"></i> View Receipt</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection