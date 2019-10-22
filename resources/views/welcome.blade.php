@extends('layout')
@section('title','Home')
@section('content')
  <!-- Header -->
  <center>
    <div class="">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100"   src="{{asset('adminlte3/dist/img/wellness.png')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('adminlte3/dist/img/slide2.png')}}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="{{asset('adminlte3/dist/img/slide3.png')}}" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  </div>
  </center>



  <!-- Page Content -->
  <div class="container mt-5">

    <div class="row">
      
      
        <div id="contact" class="col-md-12 mb-5">
            <div class="row">
              <div class="col-6">
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
                  <div>
                    <abbr title="Phone">Globe:</abbr>
                    0927-152-8926
                  </div>
                 <div>
                   <abbr title="Phone">Smart:</abbr>
                   0908-695-8978
                 </div>
                 <div>
                   <abbr title="Phone">PLDT Landline:</abbr>
                   (034) 474-3023
                 </div>
                  
                  <br>
                  <abbr title="Email"><i class="fa fa-envelope"></i> Email:</abbr>
                  <a href="mailto:rocelcantilasanoga.d­vml@gmail.com">rocelcantilasanoga.d­vml@gmail.com</a><br>
                  <abbr title="Email"><i class="fab fa-facebook"></i> Facebook:</abbr>
                  <a href="https://www.facebook.com/DrSandJVetClinic">DrSandJVetClinic</a>
                </address>
              </div>
              <div class="col-6">
                <h3>Google Map Location</h3>
                <hr><center>
                <div class="mapouter"><div class="gmap_canvas"><iframe width="500" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q=dr%20s%20and%20j%20veterinary%20clinic&t=k&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div></center>
              </div>
            </div>
        </div>
      </div>
    

  </div>
  @endsection
