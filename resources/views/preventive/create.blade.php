@extends('layouts.app')
@section('title',$title)

@section('content')

<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/appointment/{{$appointment}}/detail" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">New Service</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/appointment/{{$appointment}}/detail">
				@csrf
				<div class="form-group">
					<select class="select form-control" name="type">
						<option value="">Select Type</option>
						<option @if(old('type')=='Preventive Program') selected @endif>Preventive Program</option>
						<option @if(old('type')=='Medical History') selected @endif>Medical History</option>
					</select>
				</div>
				<div class="form-group">
					<label>Time:</label>
	                <input type="text" name="time" class="form-control">
	            </div>
				<div class="form-group"><input type="text" name="kg" class="form-control " placeholder="Kilogram" value="{{old('kg')}}" ></div>
				<div class="form-group"><input type="text" name="temp" class="form-control " placeholder="Temperature" value="{{old('temp')}}" ></div>
				<div class="form-group"><input type="text" name="price" class="form-control " placeholder="Price" value="{{old('price')}}" ></div>
				<div class="form-group"><textarea class="form-control" id="article-ckeditor" name="description" placeholder="Description">{{old('description')}}</textarea></div>
				
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>

			</form>
		</div>
	</div>
</div>
@endsection