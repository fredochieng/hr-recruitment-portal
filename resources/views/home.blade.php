@extends('adminlte::page')

@section('title', 'Dashboard | Wananchi HR Recruitment')

@section('content_header')
<h1>Dashboard</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>{{ $open_interviews_count }}</h3>

                <p>Open Interviews</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3>{{ $closed_interviews_count }}</h3>

                <p>Closed Interviews</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3>{{ $senior_interviews_count }}</h3>

                <p>Senior Roles Interviews</p>
            </div>
            <div class="icon">
                <i class="ion ion-briefcase"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-blue">
            <div class="inner">
                <h3>{{ $junior_interviews_count }}</h3>

                <p>Junior Member Interviews</p>
            </div>
            <div class="icon">
                <i class="ion ion-bookmark"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<input type="hidden" id="open_interviews" value="{{ $open_interviews_count }}">
<input type="hidden" id="inprogress_interviews" value="{{ $inprogress_interviews_count }}">
<input type="hidden" id="closed_interviews" value="{{ $closed_interviews_count }}">

<div class="row">
    <div class="col-md-8">
        <!-- DONUT CHART -->
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Interviews Chart</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart" style="height:340px"></canvas>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>

    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-log-out"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Exit Interviews</span>
                <span class="info-box-number">{{ $exit_interviews_count }}</span>
            </div>
        </div>

        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fas fa-fw fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Panelists</span>
                <span class="info-box-number">{{ $panelists_count }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>

        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Interviewed Candidates</span>
                <span class="info-box-number">{{ $interviewed_candidates_count }}</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-pricetags"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Departments</span>
                <span class="info-box-number">{{ $departments_count }}</span>
            </div>
        </div>
        @if(auth()->user()->isHRDirector())
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-pricetags"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Departments</span>
                <span class="info-box-number">{{ $departments_count }}</span>
            </div>
        </div>
        @elsef(auth()->user()->isHR())
        <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="ion ion-pricetags"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Job Postings</span>
                <span class="info-box-number">{{ $job_postings_count }}</span>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-6" hide>
        <!-- AREA CHART -->
        <div class="box box-primary hide">
            <div class="box-header with-border">
                <h3 class="box-title">Area Chart</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body hide">
                <div class="chart">
                    <canvas id="areaChart" style="height:250px"></canvas>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col (LEFT) -->
    <div class="col-md-6 hide">
        <!-- LINE CHART -->
        <div class="box box-info hide">
            <div class="box-header with-border">
                <h3 class="box-title">Line Chart</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body hide">
                <div class="chart">
                    <canvas id="lineChart" style="height:275px"></canvas>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>
    <!-- /.col (RIGHT) -->
</div>

@stop
@section('css')
@stop
@section('js')

<script src="/js/Chart.js"></script>
<script>
    $(function () {
        "use strict";
      /* ChartJS
       * -------
       * Here we will create a few charts using ChartJS
       */

      //--------------
      //- AREA CHART -
      //--------------

      // Get context with jQuery - using jQuery's .get() method.
      var areaChartCanvas = $('#areaChart').get(0).getContext('2d')
      // This will get the first returned node in the jQuery collection.
      var areaChart = new Chart(areaChartCanvas)

      var areaChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'Electronics',
            fillColor: 'rgba(210, 214, 222, 1)',
            strokeColor: 'rgba(210, 214, 222, 1)',
            pointColor: 'rgba(210, 214, 222, 1)',
            pointStrokeColor: '#c1c7d1',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data: [65, 59, 80, 81, 56, 55, 40]
          },
          {
            label: 'Digital Goods',
            fillColor: 'rgba(60,141,188,0.9)',
            strokeColor: 'rgba(60,141,188,0.8)',
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [28, 48, 40, 19, 86, 27, 90]
          }
        ]
      }

      var areaChartOptions = {
        //Boolean - If we should show the scale at all
        showScale: true,
        //Boolean - Whether grid lines are shown across the chart
        scaleShowGridLines: false,
        //String - Colour of the grid lines
        scaleGridLineColor: 'rgba(0,0,0,.05)',
        //Number - Width of the grid lines
        scaleGridLineWidth: 1,
        //Boolean - Whether to show horizontal lines (except X axis)
        scaleShowHorizontalLines: true,
        //Boolean - Whether to show vertical lines (except Y axis)
        scaleShowVerticalLines: true,
        //Boolean - Whether the line is curved between points
        bezierCurve: true,
        //Number - Tension of the bezier curve between points
        bezierCurveTension: 0.3,
        //Boolean - Whether to show a dot for each point
        pointDot: false,
        //Number - Radius of each point dot in pixels
        pointDotRadius: 4,
        //Number - Pixel width of point dot stroke
        pointDotStrokeWidth: 1,
        //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
        pointHitDetectionRadius: 20,
        //Boolean - Whether to show a stroke for datasets
        datasetStroke: true,
        //Number - Pixel width of dataset stroke
        datasetStrokeWidth: 2,
        //Boolean - Whether to fill the dataset with a color
        datasetFill: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].lineColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
        //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true
      }

      //Create the line chart
      areaChart.Line(areaChartData, areaChartOptions)

      //-------------
      //- LINE CHART -
      //--------------
      var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
      var lineChart = new Chart(lineChartCanvas)
      var lineChartOptions = areaChartOptions
      lineChartOptions.datasetFill = false
      lineChart.Line(areaChartData, lineChartOptions)




var open_interviews = $('#open_interviews');
var inprogress_interviews = $('#inprogress_interviews');
var closed_interviews = $('#closed_interviews');

var open_interviews = open_interviews.val();
var inprogress_interviews = inprogress_interviews.val();
var closed_interviews = closed_interviews.val();

var open_interviews = open_interviews;
var inprogress_interviews = inprogress_interviews;
var closed_interviews = closed_interviews;


      //-------------
      //- PIE CHART -
      //-------------
      // Get context with jQuery - using jQuery's .get() method.
      var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
      var pieChart = new Chart(pieChartCanvas)
      var PieData = [{
          value: inprogress_interviews.valueOf(),
          color: '#f56954',
          highlight: '#f56954',
          label: 'Ongoing Interviews'
        },
        {
          value: closed_interviews.valueOf(),
          color: '#00a65a',
          highlight: '#00a65a',
          label: 'Closed Interviews'
        },
        {
          value: open_interviews.valueOf(),
          color: '#00c0ef',
          highlight: '#00c0ef',
          label: 'Open Interviews'
        }
      ]
      var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: '#fff',
        //Number - The width of each segment stroke
        segmentStrokeWidth: 2,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: 'easeOutBounce',
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: true,
        //String - A legend template
        legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
      }
      //Create pie or douhnut chart
      // You can switch between pie and douhnut using the method below.
      pieChart.Doughnut(PieData, pieOptions)
    })
</script>
@stop