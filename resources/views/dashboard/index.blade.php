@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="row">
      <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-calendar"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Appointments</span>
          <span class="info-box-number text-center">
            {{$appointmentscount}}    
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
  <!-- JUMBOTRON -->
  <div class="col-md-8">
    <div class="card">
      <div class="card-header">
        <span class="card-title">Supplier Reminders</span>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-widget="remove">
            <i class="fas fa-times"></i>
          </button>

          </div>
      </div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover m-0">
           <thead>
              <tr>
             
                <th>Supplier</th>
                <th>Terms</th>
                <th>Discount</th>
                <th>Amount</th>
                <th>Delivery</th>
                <th>Due</th>
                <th>Status</th>
              </tr>
           </thead>
           <tbody>
             @if(count($stockins))
              @foreach($stockins as $stockin)
              <tr>
            
                <td>{{$stockin->supplier->name}}</td>
                <td>{{$stockin->term}}</td>
                <td>{{$stockin->discount}}</td>
                <td class="text-right">&#8369; {{number_format($stockin->amount,2)}}</td>
                <td>{{date('M d, D Y', strtotime($stockin->delivery_date))}}</td>
                <td>{{date('M d, D Y', strtotime($stockin->due))}}</td>
                <td>
                  <form method="POST" action="/dashboard/UpdateStockin/{{$stockin->id}}">
                      @method('PATCH')
                      @csrf
                      <select onchange="this.form.submit()" class="select form-control" name="status">
                        <option @if($stockin->status == 'Unpaid') selected  @endif)>Unpaid</option>
                        <option @if($stockin->status == 'Paid') selected  @endif>Paid</option>
                      </select>
                    </form>
                </td>
              </tr>
              @endforeach
             @else
              <tr><td colspan="8" class="text-center">There are currently no reminders </td></tr>
             @endif
           </tbody>
          </table>
        </div>
       
      </div>
      <div class="card-footer">
        <div class="float-left mt-2"><a href="/dashboard/suppliers/" class="uppercase">View All Reminders</a></div>
         <div class="float-right">{{ $stockins->appends(Request::all())->links() }}</div>
      </div>
    </div>
  </div>
  <!--  -->
  <div class="col-md-4">
    <!-- PRODUCT LIST -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Product Notification</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-widget="remove">
            <i class="fas fa-times"></i>
          </button>

          </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2" style=" margin-bottom: 10px;overflow:scroll;-webkit-overflow-scrolling: touch; @if(count($stockins) >= 2) height: 230px @else height: 130px @endif">
          @if(count($lowproducts))
            <?php $check = 0;?>
          @foreach($lowproducts as $lowproduct)
    
            @if($lowproduct->quantity <= $lowproduct->lowstock)
            <?php $check = $check+1;?>
            <li class="item" >
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
  <div class="col-md-12">
    <!-- TABLE: LATEST ORDERS -->
    <div class="card">
      <div class="card-header border-transparent">
        <h3 class="card-title">Today's Appointments</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0 table-hover">
            <thead>
            <tr>
              <th>Patient ID</th>
              <th>Name</th>
              <th>Appointment</th>
              <th>Next Appointment</th>
              <th>Amount</th>
              <th>SMS Notify</th>
              <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @if(count($appointments))
              @foreach($appointments as $appointment)
              <tr>
                <td ><a href="/dashboard/patient/{{$appointment->patient->id}}/appointment" class="text-primary">{{$appointment->patient->id}}</a></td>
                <td >{{$appointment->patient->name}}</td>
                <td>{!!$appointment->description!!}</td>
                <td>{{date('M d, D Y', strtotime($appointment->next_appointment))}}</td>
                <?php $test = explode(',',$appointment['price']); ?>
                <td>&#8369; {{number_format(array_sum($test),2)}}</td>
                <td> <span class="badge badge-success">SMS Sent - Client is notified</span></td>
                <td>
                  <form method="POST" action="/dashboard/patient/{{$appointment->patient->id}}/appointment/{{$appointment->id}}/UpdateStatus">
                      @method('PATCH')
                      @csrf
                      <select onchange="this.form.submit()" class="select form-control" name="status">
                        <option @if($appointment->status == 'Not Completed') selected  @endif)>Not Completed</option>
                        <option @if($appointment->status == 'Completed') selected  @endif>Completed</option>
                        <option @if($appointment->status == 'Rescheduled') selected  @endif>Rescheduled</option>
                      </select>
                    </form>
                </td>
              </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="7" class="text-center">There are currently no appontments</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix text-center">
        <div class="float-left"><a href="/dashboard/patient" class="btn-link">View All Patients</a></div>
        <div class="float-right">{{ $appointments->appends(Request::all())->links() }}</div>
      </div>
      <!-- /.card-footer -->
    </div>
    <!-- /.card -->
  </div>
 
</div>

@endsection