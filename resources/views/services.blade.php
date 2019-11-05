@extends('layout')
@section('title','services')
@section('content')
  <!-- Page Content -->
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-6">What We Offer</h1>
    
    </div>
  </div>
  <div class="container mt-5" style="margin-bottom: 30%">

    <div class="row">
  
      
        
       @if(count($services))
        @foreach($services as $service)
        <div class="col-md-4 mb-5">
        <div class="card h-100">
          
          <div class="card-body">
            <h4 class="card-title">{{$service->title}}</h4>
            <p>{{$service->description}}</p>
            
          </div>
        </div>
         </div>
        @endforeach
          @else
            <div class="col-12 mx-auto mb-5 mt-5 lead text-center"> There are no services. </div>
          @endif
           
     

      <div class="col-12 mb-5 ">
            <div class="float-right">{{$services->appends(Request::all())->links()}}</div>
      </div>

      
    </div>
   

  </div>
  <!-- /.container -->
 @endsection