<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dr S & J Veterinary Clinic</title>
    <!-- icon -->
  <link rel="icon" type="image/x-icon" href="{{asset('adminlte3/dist/img/logo.jpg')}}">

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
            <a class="nav-link" href="{{url('/')}}">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('about')}}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{url('products')}}">Products</a>
          </li>
          <li class="nav-item">
            @guest
            <a class="nav-link" href="{{url('/login')}}">Login</a>
            @else
            <a class="nav-link" href="{{url('/dashboard')}}">Dashboard</a>
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
      <div class="col-md-8 mb-5"><h2>Announcements</h2><hr>
      @if(count($announcements))
        @foreach($announcements as $announcement)
            <div class="card">
                <img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$announcement->cover_image}}" width="100%" height="300px">
              <div class="card-body">
                <h4 class="card-title">{{$announcement->title}}</h4>
                <span><strong>Author:</strong> {{$announcement->user->email}}</span><br>
                 <span><strong>Posted at: </strong>{{$announcement->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</span>
                <p class="card-text">{!!$announcement->body!!}</p>
              </div>
              <div class="card-footer">
                <a href="#" class="btn btn-primary">Read More</a>
              </div>
            </div>  
      @endforeach
      @else
        <div class="mx-auto mb-5 mt-5 lead text-center"> There are no announcements. </div>
      @endif
        <div class="mb-5 mt-5"><div class="float-right">{{$announcements->links()}}</div></div>
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
          <h3>Google Map Location</h3>
          <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=dr%20s%20and%20j%20veterinary%20clinic&t=k&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
      </div>
    </div>
   

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
