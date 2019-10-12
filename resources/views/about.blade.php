@extends('layout')
@section('title','Announcements')
@section('content')
  <!-- Page Content -->
  <div class="container mt-5" style="margin-bottom: 30%">

    <div class="row" >

      <div id="about" class=" col-md-12 mb-5" >
        <h2 class="col-md-12">Announcements</h2>
        <div class="">
          @if(count($announcements))
           <div class="col-md-8 mx-auto">
               @foreach($announcements as $announcement)
                   <div class="card mt-2">
                     <div class="card-body">
                       <h4 class="card-title" style="margin-bottom: 0px">{{$announcement->title}}</h4>
                       <small><strong>Author:</strong> {{$announcement->user->email}}</small><br>
                        <small><strong>Date Posted: </strong>{{$announcement->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</small>
                        <center><img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$announcement->cover_image}}" width="400px" height="200px"></center>
              
                        <div class="mt-2">
                          <p class="card-text" style="text-align: justify">{!!$announcement->body!!}</p>
                        </div>
                     </div>
                     
                   </div>  
             @endforeach
           </div>
          @else
            <div class="col-md-12 mb-5 mt-5 lead text-center"> There are no announcements. </div>
          @endif
            <div class="mb-5 mt-5"><div class="float-right">{{$announcements->links()}}</div></div>
        </div>
      </div>

     
    </div>
   

  </div>
  <!-- /.container -->
   @endsection
