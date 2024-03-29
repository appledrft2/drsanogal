@extends('layouts.app')
@section('title',$title)

@section('content')


<div class="col-md-10 mx-auto">
	<div class="form-group">
		<a href="/dashboard/announcement" class="btn btn-default">Go Back</a>
	</div>
	<div class="card">
		<div class="card-header">New Announcement</div>
		<div class="card-body">
			<form  class="" method="POST" enctype="multipart/form-data" action="/dashboard/announcement">
				@csrf
				<div class="form-group"><input type="text" name="title" class="form-control " placeholder="Title" value="{{old('title')}}" ></div>
				<div class="form-group"><textarea class="form-control textarea" name="body" placeholder="Body"></textarea>{{old('body')}}</div>
				<div class="form-group">
					<input type="file" name="cover_image" class="form-control-file mb-5"  accept="image/*">
				</div> 
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection
