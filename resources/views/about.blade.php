@extends('layout')
@section('title','Announcements')
@section('content')
  <!-- Page Content -->
  <div class="container">

    <div class="row">
      
      <div id="about" class="col-md-8 mb-5">
        <h2>Announcements</h2><hr>
            @if(count($announcements))
              @foreach($announcements as $announcement)
                  <div class="card mt-2">
                      <img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$announcement->cover_image}}" width="100%" height="300px">
                    <div class="card-body">
                      <h4 class="card-title">{{$announcement->title}}</h4>
                      <span><strong>Author:</strong> {{$announcement->user->email}}</span><br>
                       <span><strong>Posted at: </strong>{{$announcement->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</span>
                      <p class="card-text">{!!str_limit($announcement->body, 50)!!}</p>
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
  <!-- /.container -->
   @endsection
