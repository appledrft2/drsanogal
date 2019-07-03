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
		<button onclick="history.back()" class="btn btn-default">Go Back</button>
	</div>
	<div class="card">
		<div class="card-header">New Announcement</div>
		<div class="card-body">
			<form  class="" method="POST" action="/dashboard/announcement">
				@csrf
				<div class="form-group"><input type="text" name="title" class="form-control " placeholder="Title" value="{{old('title')}}" ></div>
				<div class="form-group"><textarea class="form-control" id="article-ckeditor" name="body" placeholder="Body"></textarea>{{old('body')}}</div>
				<button type="submit" class="btn btn-default btn-md"><i class="fa fa-save"></i> Save</button>
			</form>
		</div>
	</div>
</div>
@endsection