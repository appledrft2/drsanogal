@extends('layouts.app')
@section('title',$title)

@section('content')

@if($errors->any())
	@foreach($errors->all() as $error)
		<div class="alert alert-danger">{{$error}}</div>
	@endforeach
@endif
<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/announcement" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">Update Announcement</div>
		<div class="card-body">
			<form  class="" method="POST" enctype="multipart/form-data" action="/dashboard/announcement/{{$announcement->id}}">
				@method('PUT')
				@csrf
				<div class="form-group"><input type="text" name="title" class="form-control " placeholder="Name" value="{{$announcement->title}}" ></div>
				<div class="form-group"><textarea class="form-control textarea" name="body" placeholder="Address">{{$announcement->body}}</textarea></div>
				<div class="form-group">
					<img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$announcement->cover_image}}" class="img-fluid rounded" style="width: 200px;height:100px">
				</div> 
				<div class="form-group">
					<input type="file" name="cover_image" class="form-control-file mb-5">
				</div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection