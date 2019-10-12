@extends('layout')
@section('title','Products')
@section('content')
  <!-- Page Content -->
  <div class="container mt-5 " style="margin-bottom: 30%">

    <div class="row">
      <div class="col-md-12"><h2>Available Products</h2><hr></div>
      
        
       @if(count($products))
        @foreach($products as $product)
        <div class="col-md-4 mb-5">
        <div class="card h-100">
          <img class="card-img-top" src="https://vetassist.s3.ap-southeast-1.amazonaws.com/{{$product->image}}" style="width: 100%;height: 200px" alt="product">
          <div class="card-body">
            <h4 class="card-title">{{$product->name}}</h4>
            <p class="card-text">
              <span><strong>Price:</strong> &#8369;{{number_format($product->price,2)}}</span><br>
              <span><strong>Category:</strong> {{$product->category}}</span><br>
            </p>
          </div>
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