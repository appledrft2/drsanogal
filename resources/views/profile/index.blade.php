@extends('layouts.app')
@section('title',$title)
@section('content')
<!-- Profile Image -->
<div class="card ">
  <div class="card-body box-profile">
    <div class="text-center">
      <img src="@if(Auth::user()->role == 'doctor') {{asset('adminlte3/dist/img/doctor.png')}} @else {{asset('adminlte3/dist/img/staff.png')}} @endif " class="profile-user-img img-fluid img-circle" alt="User Image">
     
    </div>

    <h3 class="profile-username text-center">{{Auth::user()->name}}</h3>

    <p class="text-muted text-center">{{ucfirst(Auth::user()->role)}}</p>

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Update Information</div>
          <div class="card-body">
            <form method="POST" action="/dashboard/profile/{{Auth::user()->id}}">
              @method("PATCH")
              @csrf
              <div class="form-group">
                <label>Full name</label>
                <input type="text" class="form-control form-control-sm" name="name" value="{{Auth::user()->name}}">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control form-control-sm" name="email" value="{{Auth::user()->email}}">
              </div>
              <div class="form-group">
                <button class="btn btn-default"><i class="fa fa-save"></i> Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">Update Password</div>
          <div class="card-body">
            <div class='alert alert-info' role='alert'><i class='fa fa-key'></i> Leave the password field empty if you don't want to change.</div>
            <form method="POST" action="/dashboard/profile/{{Auth::user()->id}}/password">
              @method("PATCH")
              @csrf
              <div class="form-group">
                <label>New Password</label>
                <input type="password" class="form-control form-control-sm" name="password" value="">
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control form-control-sm" name="password_confirmation" value="">
              </div>
              <div class="form-group">
                <button class="btn btn-default"><i class="fa fa-save"></i> Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection