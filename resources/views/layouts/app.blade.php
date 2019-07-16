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
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/summernote/summernote-bs4.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/datatables/dataTables.bootstrap4.min.css')}}">
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
          <img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{Auth::user()->image}}" class="img-circle elevation-2" alt="User Image" style="width: 40px;height: 40px">
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
      <nav class="mt-1 mb-5">
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
            <a href="/dashboard/patient" class="nav-link @if($title=='Patient') active @endif">
              <i class="nav-icon fas fa-paw"></i>
              <p>
                Patient
              </p>
            </a>
          </li>
          @endif

          @if(Auth::user()->role == 'doctor')
          <li class="nav-item">
            <a href="/dashboard/appointmentlist" class="nav-link @if($title=='Appointment List') active @endif">
              <i class="nav-icon fas fa-calendar"></i>
              <p>
                Appointments
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
            <a href="/dashboard/suppliers" class="nav-link @if($title=='Stock In') active @endif">
              <i class="nav-icon fas fa-truck"></i>
              <p>
                Stock In
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="/dashboard/stockout" class="nav-link @if($title=='Point of Sale') active @endif">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Point of Sale
              </p>
            </a>
          </li>
          @if(Auth::user()->role == 'doctor')
          <li class="nav-item">
            <a href="/dashboard/report" class="nav-link @if($title=='Report') active @endif">
              <i class="nav-icon fas fa-book"></i>
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
<!-- for mobile browsers -->
<script src="{{asset('adminlte3/plugins/fastclick/fastclick.js')}}"></script>
<script src="{{asset('adminlte3/plugins/moment/moment.min.js')}}"></script>



<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>

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

  @include('sweetalert::alert')
  @if($errors->any())
    @foreach($errors->all() as $error)
      <script type="text/javascript">
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          });
          Toast.fire({
            type: 'error',
            title: '{{$error}}'
          });
      </script>
    @endforeach
  @endif
  <script type="text/javascript">
    $(document).on('click', '.btn-submit', function(e){
      e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.value) {
            form.submit();
          }
        });
    });
  </script>

<!-- DataTables -->
<script src="{{asset('adminlte3/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte3/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('adminlte3/plugins/summernote/summernote-bs4.min.js')}}"></script>
  
<script>
  $(function () {
    $("#productlist").DataTable();
     $("#productlist2").DataTable();
      $("#servicelist").DataTable();
      $("#table").DataTable();
  });
</script>
<!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/pjax/pjax.min.js"></script>
<script type="text/javascript">
  var pjax = new Pjax({
  elements: "a", // default is "a[href], form[action]"
  selectors: ["title","body"]
})
document.addEventListener('pjax:send', $('.content').fadeOut(200));
document.addEventListener('pjax:complete', $('.content').fadeIn(300));
</script> -->

<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>

@yield('script','')
</body>
</html>
