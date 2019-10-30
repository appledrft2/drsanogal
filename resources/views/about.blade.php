@extends('layout')
@section('title','Announcements')
@section('content')
  <!-- Page Content -->
  <div class="container mt-5" style="margin-bottom: 30%">

    <div class="row" >

      <div id="about" class=" col-md-12 mb-5" >
        <h2 class="col-md-12">Announcements</h2>
        <hr>
        <div class="">
          @if(count($announcements))
           <div class="col-md-8 mx-auto">
               @foreach($announcements as $announcement)
                   <div class="card mt-2">
                     <div class="card-body">
                       <h2 class="card-title" style="margin-bottom: 0px">{{ucfirst($announcement->title)}}</h2>
             
                        <small><strong>Date Posted: </strong>{{$announcement->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')}}</small>
                        <hr>
                        

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
