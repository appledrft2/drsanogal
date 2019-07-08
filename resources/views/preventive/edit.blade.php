@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/appointment/{{$appointment}}/preventive" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">Update Service</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/appointment/{{$appointment}}/preventive/{{$preventive->id}}">
				@method('PATCH')
				@csrf
				<div class="form-group"></div>

				<div class="form-group">
					<label>Time:</label>
	                <div class="input-group date" id="timepicker" data-target-input="nearest">
	                    <input type="text" name="time" value="{{$preventive->time}}" class="form-control datetimepicker-input" data-target="#timepicker"/>
	                    <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
	                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
	                    </div>
	                </div>
	            </div>
				<div class="form-group"><input type="text" name="kg" class="form-control " placeholder="Kilogram" value="{{$preventive->kg}}" ></div>
				<div class="form-group"><input type="text" name="temp" class="form-control " placeholder="Temperature" value="{{$preventive->temp}}" ></div>
				<div class="form-group"><input type="text" name="price" class="form-control " placeholder="Price" value="{{$preventive->price}}" ></div>
				<div class="form-group"><textarea class="form-control" id="article-ckeditor" name="description" placeholder="Description">{{$preventive->description}}</textarea></div>
				
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>

			</form>
		</div>
	</div>
</div>
@endsection