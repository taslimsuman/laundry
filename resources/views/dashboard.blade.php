@extends('layouts.admin')
@section('content')

@section('style')
 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
@stop
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Present Due</span>
              <span class="info-box-number">{{$db_top['getPresentDue']}} {{$home->currency}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales Last Month</span>
              <span class="info-box-number">{{$db_top['getSaleLastMonth']}} {{$home->currency}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Sales this month</span>
              <span class="info-box-number">{{$db_top['getSaleThisMonth']}} {{$home->currency}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Customers</span>
              <span class="info-box-number">{{$db_top['getTotalCustomers']}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>

<!-- row 2 -->

<!-- chart -->

  <div class="row">
     <center>
       <h2 class="text-center">Sales chart for last 15 days</h2>
     </center>
    <div class="col-md-6">
      <div class="box box-info">
          <div id="bar-example" style="height: 250px;"></div>
        </div>

    </div>
     <div class="col-md-6">
      <div class="box box-info">
          <div id="chart-line" style="height: 250px;"></div>
        </div>

    </div>
  </div>




@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
var chart = Morris.Bar({
  element: 'bar-example',
  data: [{!!$db_top['chart']!!}],
  xkey: 'date',
  ykeys: ['total_sales'],
  labels: ['Sales by Date']
});

var chart2 = Morris.Line({
  element: 'chart-line',
  data: [{!!$db_top['chart']!!}],
  xkey: 'date',
  ykeys: ['total_sales'],
  labels: ['Sales by Date']
});




</script>
@stop