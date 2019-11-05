@extends('layout')
@section('title','Home')
@section('content')

<div id="carousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img style="height: 91vh;" class="d-block w-100"   src="{{asset('adminlte3/dist/img/slides-1-v2.jpg')}}" alt="First slide">
    </div>
    <div class="carousel-item">
      <img style="height: 91vh;" class="d-block w-100" src="{{asset('adminlte3/dist/img/slides-2-v2.jpg')}}" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img style="height: 91vh;" class="d-block w-100" src="{{asset('adminlte3/dist/img/slides-3-v2.jpg')}}" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="jumbotron jumbotron-fluid col-center" style="height: 100vh">
  <div class="container" style="margin-top:30vh">
    <h1 class="display-4">Why are we here?</h1>
    <p class="lead">It is our mission to provide hollistic approach to animal health care with quality products, advance technology and continuous education to our staff, veterinarians and pet owners.</p>
  </div>
</div>

  <!-- Page Content -->
  <div class="container mt-5">
    <div class="row mb-5">
        
    
              <div class="col-lg-6 col-sm-12 ">
               <div class="card">
                  <h2 class="card-header">Contact Us</h2>
                  <div class="card-body">
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
              
               </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="card">
                  <h3 class="card-header">Our Location</h3>
                <div class="card-body">
                  <center>
                <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="250" id="gmap_canvas" src="https://maps.google.com/maps?q=dr%20s%20and%20j%20veterinary%20clinic&t=k&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div></center>
                </div>
                </div>
              </div>
        
     
      </div>
    

  </div>
  @endsection
