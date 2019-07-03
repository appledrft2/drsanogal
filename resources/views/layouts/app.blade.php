<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>{{config('APP_NAME','Vet Assistant')}} - @yield('title','Vet Assistant')</title>
  <!-- icon -->
  <link rel="icon" type="image/x-icon" href="{{asset('adminlte3/dist/img/logo.jpg')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('adminlte3/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        <button onclick="togglefs()" type="button" class="toggle-expand-btn btn"><i class="fa fa-expand"></i></button>
      </li>
      
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">1</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-left">
          <span class="dropdown-header">Product Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-archive mr-3 text-danger"></i> Product Whiskas low in stocks
            
          </a>
          
          <div class="dropdown-divider"></div>
          <a href="/product" class="dropdown-item dropdown-footer">See All Product</a>
        </div>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <form id="logout-form" style="margin:0px" action="{{ route('logout') }}" method="POST" >
            @csrf
            <button type="submit" class="btn"><i class="fa fa-sign-out-alt"></i> Logout</button>
        </form>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{asset('adminlte3/dist/img/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Vet Assistant</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="@if(Auth::user()->role == 'doctor') {{asset('adminlte3/dist/img/doctor.png')}} @else {{asset('adminlte3/dist/img/staff.png')}} @endif " class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}</a>
            <div class="form-inline">
                <a href="#" class="d-block text-sm">{{ ucfirst(Auth::user()->role) }} - &nbsp;</a> 
                <a href="/dashboard/profile" class="d-block text-sm">View Profile</a>
            </div>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="/dashboard" class="nav-link @if($title=='Dashboard') active @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/announcement" class="nav-link @if($title=='Announcement') active @endif">
              <i class="nav-icon fas fa-bullhorn"></i>
              <p>
                Announcement
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/client" class="nav-link @if($title=='Client') active @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Client
              </p>
            </a>
          </li>
          @if(Auth::user()->role == 'doctor')
          <li class="nav-item">
            <a href="/dashboard/patient" class="nav-link @if($title=='Patient_history') active @endif">
              <i class="nav-icon fas fa-paw"></i>
              <p>
                Patient
              </p>
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a href="/dashboard/supplier" class="nav-link @if($title=='Supplier') active @endif">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Supplier
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/product" class="nav-link @if($title=='Product') active @endif">
              <i class="nav-icon fas fa-archive"></i>
              <p>
                Product
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/stockin" class="nav-link @if($title=='Stock In') active @endif">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Stock In
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/stockout" class="nav-link @if($title=='Stock Out') active @endif">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Stock Out
              </p>
            </a>
          </li>
          @if(Auth::user()->role == 'doctor')
          <li class="nav-item">
            <a href="/dashboard/report" class="nav-link @if($title=='Report') active @endif">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Report
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/account" class="nav-link @if($title=='Account') active @endif">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Account
              </p>
            </a>
          </li>
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Main content -->
    <div class="content">
      <div class="container">
        <br/ >

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{session('success')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              {{session('error')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        @endif

        @yield('content')
        <br />
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Made with 💕 Laravel Framework
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2019-2020 <a href="{{url('/')}}" class="text-info">Vet Assistant</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('adminlte3/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte3/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte3/dist/js/adminlte.min.js')}}"></script>
<script>
// This will toggle fullscreen by on or off
  var fs = false;
  function togglefs(){
    if(fs == false){
      openFullscreen();
      fs = true;
    }if(fs == true){
      closeFullscreen();
      fs = false;
    }
  }
/* Get the documentElement (<html>) to display the page in fullscreen */
var elem = document.documentElement;

/* View in fullscreen */
function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}

/* Close fullscreen */
function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }
}
</script>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>
