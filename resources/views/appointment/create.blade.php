@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/patient/{{$patient}}/appointment" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">New Appointment</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/patient/{{$patient}}/appointment">
				@csrf
				<div class="form-group"></div>

				<div class="form-group"><label>Date visited:</label><input type="date" name="date_from" class="form-control " placeholder="Date visited" value="{{old('date_from')}}" ></div>
				<div class="form-group"><label>Next appointment:</label><input type="date" name="date_to" class="form-control " placeholder="Date visited" value="{{old('date_to')}}" ></div>
				<!-- <div class="form-group"><textarea class="form-control" id="article-ckeditor" name="description" placeholder="Description">{{old('description')}}</textarea></div> -->
				
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>

			</form>
		</div>
	</div>
</div>
@endsection