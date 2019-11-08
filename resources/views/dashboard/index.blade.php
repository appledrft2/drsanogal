@extends('layouts.app')
@section('title',$title)
@section('content')

	<div class="row">
      <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dollar-sign"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Monthly Gross</span>
          <span class="info-box-number text-center">
             &#8369; {{number_format($gross,2)}}  
          </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-dollar-sign"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Monthly Profit</span>
          <span class="info-box-number text-center">
             &#8369; {{number_format($net,2)}}    
          </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-dollar-sign"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Today's Income</span>
          <span class="info-box-number text-center">
            &#8369; {{number_format($today,2)}}    
          </span>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
      <div class="info-box">
        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-dollar-sign"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Last week's Income</span>
          <span class="info-box-number text-center">
            &#8369; {{number_format($week,2)}}    
          </span>
        </div>
      </div>
    </div>
	</div>

<div class="row">
  <div class="@if(Auth::user()->role == 'doctor') col-md-12 @else col-md-12 @endif">
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
              <th>Owner</th>
            
              <th>Name</th>
              <th>Appointment</th>
              <th>Date of appointment</th>
              <th>Status</th>
              <th>SMS Notification</th>
      
            </tr>
            </thead>
            <tbody>
            @if(count($appointments))
              @foreach($appointments as $appointment)
              <tr>
                <td>{{$appointment->patient->client->name}}</td>
                <td >{{$appointment->patient->name}}</td>
                <td>{{$appointment->appointment}}</td>
                <td>{{date('M d, D Y', strtotime($appointment->next_appointment2))}}</td>
                <td>
                  <form method="POST" action="/dashboard/patient/{{$appointment->patient->id}}/appointment/{{$appointment->id}}/UpdateStatus">
                    @csrf
                     @method('PATCH')
                    <select onchange="this.form.submit()" name="isCompleted" class="form-control">
                      <option @if($appointment->isCompleted == 1) selected @endif value="1">Completed</option>
                      <option @if($appointment->isCompleted == 0) selected @endif value="0">Not Completed</option>
                    </select>
                  </form>
                </td>
                <td> @if($appointment->isNotified == 1) <span class="badge badge-success">SMS Sent - Owner is notified yesterday</span> @else <span class="badge badge-secondary">SMS Failed: The owner may not <br> have a mobile #</span> @endif</td>
               
              </tr>
              @endforeach
              @else
                <tr>
                  <td colspan="7" class="text-center">There are currently no appointments</td>
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
  
  
  <!-- JUMBOTRON -->
  @if(Auth::user()->role == 'doctor')
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
                <th>Mode of Payment</th>
                <th>Discount</th>
                <th  width="15%">Amount</th>
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
                <td>{{$stockin->mop}}</td>
                <td>

                  @if($stockin->discount == 0)
                  No Discount
                  @else
                  {{$stockin->discount * 100}} %
                  @endif

                </td>
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
  @endif
  <div class="col-md-4">
    <!-- PRODUCT LIST -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Product Threshold</h3>
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
                       Product Threshold: {{$lowproduct->lowstock}} items
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
              <li class="item text-center">No product in threshold</li>
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

</div>

@endsection