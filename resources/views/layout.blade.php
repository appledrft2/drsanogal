<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dr S & J Veterinary Clinic - @yield('title','')</title>
  <!-- icon -->
  <link rel="icon" type="image/x-icon" href="{{asset('adminlte3/dist/img/logo.jpg')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Bootstrap core CSS -->
  <link href="{{asset('css/app.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/business-frontpage.css')}}" rel="stylesheet">
  <style type="text/css">
    .selected-tab{
      border-bottom: 1px white solid;

    }
  </style>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: #54C4CF;">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="{{asset('adminlte3/dist/img/logo.jpg')}}" alt="logo" width="5%" style="border-radius:90%;border:2px solid white">
       <span class="text-white"> Dr S & J Veterinary Clinic and Grooming Centre</span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item   ">
            <a class="nav-link @if(Request::is('/')) selected-tab text-white @else text-white @endif" href="{{url('/')}}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link @if(Request::is('announcement')) selected-tab text-white @else text-white @endif" href="{{url('/announcement')}}">Announcements</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link  @if(Request::is('products')) selected-tab text-white @else text-white @endif" href="{{url('products')}}">Products</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link  @if(Request::is('services')) selected-tab text-white @else text-white @endif" href="{{url('services')}}">Services</a>
          </li>
          <li class="nav-item @if(Request::is('/login') || Request::is('/dashboard') ) selected-tab text-white @else text-white @endif">
            @guest
              @if($initialInstall == 0)
              <a class="nav-link text-white" href="{{url('/register')}}">Register</a>
              @else
              <a class="nav-link text-white" href="{{url('/login')}}">Login</a>
              @endif
            @else
            <a class="nav-link text-white" href="{{url('/dashboard')}}">Dashboard</a>
            @endguest
          </li>
        </ul>
      </div>
    </div>
  </nav>


  <!-- Page Content -->

    @yield('content')


  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-2" style="background-color: #2c3e50">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Dr S & J Veterinary Clinic 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!--Start of Tawk.to Script-->
  <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/5d203b2e22d70e36c2a46771/default';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script>
  <!--End of Tawk.to Script-->
</body>
</html>