@extends('layouts.app')
@section('title',$title)
@section('content')
	<div class="card card-success">
              <div class="card-header">
                <h3 class="card-title text-center">Monthly Sales of {{date('Y')}} (Net Income)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-widget="remove"><i class="fas fa-times"></i></button>
                </div>
              </div>

		<div class="card-body">
			  <div class="col-md-12">
	                  <div class="chart">
	                  <canvas id="barChart" height="50px" ></canvas>
	                </div>
               </div>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="table-responsive">
				<table id="table" class="table table-bordered">
					<thead>
						<tr>
							<th>#</th>
							<th>Receipt No.</th>
							<th>Amount</th>
							<th>Transaction Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php $i=1; ?>
						@foreach($reports as $report)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$report->rcode}}</td>
								<td>&#8369; {{number_format($report->amount,2)}}</td>
								<td>{{$report->created_at->diffForhumans()}}</td>
								<td>
									<a href="receipt/{{$report->rcode}}" class="btn btn-default btn-sm"><i class="fa fa-list"></i> View Receipt</a>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
@endsection

@section('script')
<!-- Chart JS -->
<script src="{{asset('adminlte3/plugins/chartjs-old/Chart.min.js')}}"></script>
<script>
	loadBarChart();
function loadBarChart(){

    var jan = {{$jan}};
    var feb = {{$feb}};
    var march = {{$march}};
    var april = {{$april}};
    var may = {{$may}};
    var june = {{$june}};
    var july = {{$july}};
     var aug = {{$aug}};
    var sept = {{$sept}};
    var oct = {{$oct}};
    var nov = {{$nov}};
    var dec = {{$dec}};

    $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
     var areaChartData = {
      labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
      datasets: [
        {
          label               : 'Electronics',
          fillColor           : 'rgba(210, 214, 222, 1)',
          strokeColor         : 'rgba(210, 214, 222, 1)',
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : [jan, feb, march, april, may, june, july,aug, sept,oct, nov,dec]
        }
      ]
    }

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas                   = $('#barChart').get(0).getContext('2d')
    var barChart                         = new Chart(barChartCanvas)
    var barChartData                     = areaChartData
    barChartData.datasets[0].fillColor   = '#00a65a';
    barChartData.datasets[0].strokeColor = '#00a65a';
    barChartData.datasets[0].pointColor  = '#00a65a';
    var barChartOptions                  = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero        : true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines      : true,
      //String - Colour of the grid lines
      scaleGridLineColor      : 'rgba(0,0,0,.05)',
      //Number - Width of the grid lines
      scaleGridLineWidth      : 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines  : true,
      //Boolean - If there is a stroke on each bar
      barShowStroke           : true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth          : 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing         : 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing       : 1,
      //String - A legend template
      legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
      //Boolean - whether to make the chart responsive
      responsive              : true,
      maintainAspectRatio     : true
    }

    barChartOptions.datasetFill = false
    barChart.Bar(barChartData, barChartOptions)
  })
}
</script>
@endsection