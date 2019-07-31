@extends('layout')
@section('title','Announcements')
@section('content')
  <!-- Page Content -->
  <div class="container">

    <div class="row">
      
      <div id="about" class=" col-md-12 mb-5">
        <h2 class="col-md-12">Announcements</h2><hr>
        <div class="">
          @if(count($announcements))
           <div class="col-md-8 mx-auto">
               @foreach($announcements as $announcement)
                   <div class="card mt-2">
                       <img src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$announcement->cover_image}}" width="100%" height="300px">
                     <div class="card-body">
                       <h4 class="card-title">{{$announcement->title}}</h4>
                       <span><strong>Author:</strong> {{$announcement->user->email}}</span><br>
                        <span><strong>Date Posted: </strong>{{$announcement->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</span>
                       <p class="card-text">{!!$announcement->body!!}</p>
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
