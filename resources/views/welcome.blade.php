@extends('layout')
@section('title','Home')
@section('content')
  <!-- Page Content -->
  <div class="container">

    <div class="row">
      <div id="about" class="col-md-8 mb-5">
        <h2 class="">Why are we here?</h2>
        <hr>
        <p class="text-justify " style="font-size:1.4em" >It is our mission to provide hollistic approach to animal health care with quality products, advance technology and continuous education to our staff, veterinarians and pet owners.</p>
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
          <abbr title="Email">Email:</abbr>
          <a href="mailto:rocelcantilasanoga.d­vml@gmail.com">rocelcantilasanoga.d­vml@gmail.com</a>
        </address>
            <h3>Google Map Location</h3>
            <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=dr%20s%20and%20j%20veterinary%20clinic&t=k&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
          </div>
      </div>
    

  </div>
  @endsection
