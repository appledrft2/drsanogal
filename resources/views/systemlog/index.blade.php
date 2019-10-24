@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="card">
    
		<div class="card-body">
     		
			<div class="table-responsive">
				<table id="table" class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>User</th>
							<th>Role</th>
							<th>Activity</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						@if($logs)
				
							@foreach($logs as $key => $ts)
							<tr>
								<td>{{$ts->user}}</td>
								<td>{{$ts->role}}</td>
								<td>{{$ts->activity}}</td>
								<td>{{$ts->created_at->isoFormat('MMM D YYYY, h:mm:ss a')}}</td>
							</tr>
							@endforeach
						@endif
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

