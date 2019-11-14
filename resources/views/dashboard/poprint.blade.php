<link rel="stylesheet" href="{{asset('adminlte3/dist/css/adminlte.css')}}">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('adminlte3/plugins/fontawesome-free/css/all.min.css')}}">

<body onload="window.print();" class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<center><img class="" src="{{asset('adminlte3/dist/img/logo.jpg')}}" alt="logo" width="10%" style="border-radius:90%;border:0px solid white"></center>
			<h5 class="text-center text-uppercase">Dr S & J Veterinary Clinic and Grooming Centre</h5>
		</div>
		<div class="col-md-12">
			<h4 class="text-center">Purchase Order</h4>
			<h5>Date: {{date(' M d,  Y')}}</h5>
		</div>
		<div class="col-md-12">
			<table align="center" class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Product Category</th>
						<th>Product Threshold</th>
						<th>Product Available</th>
					</tr>
				</thead>
				<tbody>
					@if(count($lowproducts))
					           <?php $check = 0;?>
					         @foreach($lowproducts as $lowproduct)
					   
					           @if($lowproduct->quantity <= $lowproduct->lowstock)
					           <?php $check = $check+1;?>
					
						<tr>
							<td>{{$lowproduct->name}}</td>
							<td>{{$lowproduct->category}}</td>
							<td>{{$lowproduct->lowstock}}</td>
							<td>{{$lowproduct->quantity}}</td>
						</tr>
					@endif
					@endforeach
					@endif
				</tbody>
			</table>
		</div>
		
	</div>
</div>
