@extends('layouts.login')
@section('title','Login')
@section('content')
<div class="login-box" style="opacity: 0.9">
  <div class="login-logo">
    <a href="#"><img src="{{asset('adminlte3/dist/img/logo.jpg')}}" class="img-fluid" style="border-radius: 90%;width: 50%"></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
          <div class="input-group-append input-group-text">
              <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" name="password">
          <div class="input-group-append input-group-text">
              <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-12">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-info btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>



     <!--  <p class="mb-1 mt-5">
        <a href="{{ route('password.request') }}">I forgot my password</a>
      </p> -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection