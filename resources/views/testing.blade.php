@extends('layouts.app')
@section('title',$title)
@section('content')


<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="testing" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="file" class="form-control-file">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-info btn-sm" name="Submit">
                </div>
            </form>
        </div>
    </div>
</div>


@endsection