@extends('layout')
@section('title','Products')
@section('content')
  <!-- Page Content -->
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-6">Available Products</h1>
    
    </div>
  </div>
  <div class="container mt-5 " style="margin-bottom: 30%">

    <div class="row">
    
        
       @if(count($products))
        @foreach($products as $product)
        <div class="col-md-4 mb-5">
        <div class="card h-100">
          <h4 class="card-header display-5">{{$product->name}}</h4>
           <img class="card-img-top" src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$product->image}}" style="width: 100%;height: 200px" alt="product">
     
              <ul class="list-group">
                 <li class="list-group-item">
                  <strong>Category:</strong> {{$product->category}}
                </li>
                <li class="list-group-item">
                  <strong>Price:</strong> &#8369;{{number_format($product->price,2)}}
                </li>
               
              </ul>
         
        </div>
         </div>
        @endforeach
          @else
            <div class="col-12 mx-auto mb-5 mt-5 lead text-center"> There are no products. </div>
          @endif
           
     

      <div class="col-12 mb-5 ">
            <div class="float-right">{{$products->appends(Request::all())->links()}}</div>
      </div>

      
    </div>
   

  </div>
  <!-- /.container -->
 @endsection