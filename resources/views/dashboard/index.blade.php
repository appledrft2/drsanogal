@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="row">
      <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-bullhorn"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Announcements</span>
          <span class="info-box-number text-center">
            {{$announcements}}    
          </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-archive"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Products</span>
          <span class="info-box-number text-center">
            {{$products}}    
          </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Clients</span>
          <span class="info-box-number text-center">
            {{$clients}}    
          </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-paw"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Patients</span>
          <span class="info-box-number text-center">
            {{$patients}}    
          </span>
        </div>
      </div>
    </div>
	</div>

<div class="row">
  <div class="col-md-8">
    <div class="jumbotron">
      <h1 class="display-4 text-display">Welcome to the dashboard!</h1>
    </div>
  </div>

  <div class="col-md-4">
    <!-- PRODUCT LIST -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Product Notification</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>

          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2">
          @if(count($lowproducts))
            <?php $check = 0;?>
          @foreach($lowproducts as $lowproduct)
            
            @if($lowproduct->quantity <= $lowproduct->lowstock)
            <?php $check = $check+1;?>
            <li class="item">
              <div class="row">
                <div class="col-md-8">
                    <a href="dashboard/product/" class="lead text-dark">{{$lowproduct->name}}
                     </a>
                    <span class="product-description">
                       {{$lowproduct->category}}<br>
                       Only {{$lowproduct->quantity}} stocks remaining <br>
                       Product critical: {{$lowproduct->lowstock}} items
                    </span>
                </div>
                <div class="col-md-4">
                  <div class="info-box">
                    <span class="info-box-icon bg-danger ml-2"><i class="fas fa-truck"></i></span>
                  </div>
                </div>
              </div>
            </li>
            @endif
          @endforeach
            @if($check == 0)
              <li class="item text-center">No product in critical level</li>
            @endif
          @else
          <li class="item text-center">There are no products</li>
          @endif
          <!-- /.item -->
        </ul>
      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center">
        <a href="/dashboard/product" class="uppercase">View All Products</a>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>

  <div class="col-md-8">
    
  </div>
</div>



@endsection