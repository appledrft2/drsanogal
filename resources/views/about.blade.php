@extends('layout')
@section('title','About')
@section('content')
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
          <h3>Google Map Location</h3>
          <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="400" id="gmap_canvas" src="https://maps.google.com/maps?q=dr%20s%20and%20j%20veterinary%20clinic&t=k&z=19&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div></div>
      </div>
    </div>
   

  </div>
  <!-- /.container -->
   @endsection
