<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dr S & J Veterinary Clinic</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('css/app.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/business-frontpage.css')}}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">
        <img src="{{asset('adminlte3/dist/img/logo.jpg')}}" alt="logo" width="5%" style="border-radius:90%">
        Dr S & J Veterinary Clinic and Grooming Centre
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact</a>
          </li>
          <li class="nav-item">
            @guest
            <a class="nav-link" href="/login">Login</a>
            @else
            <a class="nav-link" href="/dashboard">Dashboard</a>
            @endguest
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Header -->
  <header class="bg-light py-5 mb-5" style="background-image: url('{{asset('adminlte3/dist/img/meow.png')}}');background-size:cover;height: 40em">
    <div class="container h-100" >
      <div class="row h-100 align-items-center" >
        <div class="col-lg-12 text-">
          <h1 class="display-4 text-dark mt-5 mb-2">Welcome to our website!</h1>
          <p class="lead mb-5 text-dark-50">We offer excellent products and services for your lovely pets.</p>
        </div>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <div id="about" class="col-md-8 mb-5">
        <h2>What We Do</h2>
        <hr>
        <p class="text-justify">We have come together as a staff to decide why and how we do what we do. When taking care of our clients and patients we are guided by this vision which is further defined by our clinic’s core values, our mission and our philosophies. We then use these as a guide to help us better in our daily interactions.</p>

      </div>
      <div id="contact" class="col-md-4 mb-5">
        <h2 >Contact Us</h2>
        <hr>
        <address>
          <strong>We are located at</strong>
          <br>Door 2, Garces Bldg
          <br>Alijis Road, Brgy Alijis
          <br>Bacolod City 6100
          <br>
        </address>
        <address>
          <abbr title="Phone">P:</abbr>
          0908 695 8978
          <br>
          <abbr title="Email">E:</abbr>
          <a href="mailto:drsanogal@gmail.com">drsanogal@gmail.com</a>
        </address>
      </div>
    </div>
    <!-- /.row -->

    <div class="row">
      <div class="col-md-12 mb-5"><h2>Announcements</h2><hr></div>
    @if(count($announcements))
      @foreach($announcements as $announcement)
      <div class="col-md-8 mx-auto mb-5">
        <div class="card h-100">
          
          <div class="card-body">
            <h4 class="card-title">{{$announcement->title}}</h4>
            <span><strong>Author:</strong> {{$announcement->user->email}}</span><br>
             <span><strong>Posted at: </strong>{{$announcement->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</span>
            <p class="card-text text-justify">{!!$announcement->body!!}</p>
          </div>
          
        </div>
      </div>
      @endforeach
      @else
        <div class="col-md-8 mx-auto mb-5 lead"> There are no announcements. </div>
      @endif

      </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Dr S & J Veterinary Clinic 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
