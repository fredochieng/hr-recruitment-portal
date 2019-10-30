@extends('adminlte::page')

@section('title', 'Manage Candidate | Wananchi Group HR Recruitment')

@section('content_header')
<h1><strong>CANDIDATE NAME: {{$candidates->name}}</strong>
    <p class="pull-right">
        @if($candidates->interviewed == "CLOSED" && $candidates->interview_status == "2" && $function_head_decision ==
        'N')
        <button style="margin-top:2px" data-toggle="modal"
            data-target="#modal_second_interview_{{ $candidates->candidate_id }}" data-backdrop="static"
            data-keyboard="false" class="btn bg-purple margin"><i class="fa fa-check"></i>
            SECOND INTERVIEW
        </button>
        @endif
        @if($candidates->interviewed == "CLOSED" && $candidates->interview_status == "2" && $function_head_decision
        == 'N')
        <button style="margin-top:2px" data-toggle="modal"
            data-target="#modal_offer_letter_{{ $candidates->candidate_id }}" data-backdrop="static"
            data-keyboard="false" class="btn bg-yellow margin"><i class="fa fa-check"></i>
            OFFER LETTER
        </button>
        @endif

        @if ($candidates->opening_type == 1)
        @if($rated == 'N' && $candidates->interviewed == "ONGOING")
        <button style="margin-top:2px" data-toggle="modal"
            data-target="#modal_add_rating_senior_{{ $candidates->candidate_id }}" data-backdrop="static"
            data-keyboard="false" class="btn bg-aqua margin"><i class="fa fa-check"></i>
            START
            RATING</button>
        @else
        <button style="margin-top:2px" data-toggle="modal" disabled
            data-target="#modal_add_rating_senior_{{ $candidates->candidate_id }}" data-backdrop="static"
            data-keyboard="false" class="btn bg-aqua margin"><i class="fa fa-check"></i>
            START
            RATING</button>
        @endif
        @else
        @if($rated == 'N' && $candidates->interviewed == "ONGOING")
        <button style="margin-top:2px" data-toggle="modal"
            data-target="#modal_add_rating_{{ $candidates->candidate_id }}" data-backdrop="static" data-keyboard="false"
            class="btn bg-aqua margin"><i class="fa fa-check"></i>
            START
            RATING</button>
        @else
        <button style="margin-top:2px" data-toggle="modal" disabled
            data-target="#modal_add_rating_{{ $candidates->candidate_id }}" data-backdrop="static" data-keyboard="false"
            class="btn bg-aqua margin"><i class="fa fa-check"></i>
            START
            RATING</button>
        @endif
        @endif
        @if($candidates->interviewed == "ONGOING")
        <button style="margin-top:2px" data-toggle="modal"
            data-target="#modal_close_candidate_session_{{ $candidates->candidate_id }}" data-backdrop="static"
            data-keyboard="false" class="btn bg-green margin"><i class="fa fa-check"></i>
            CLOSE
            SESSION</button>
        @endif
    </p>
</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body with-border">

        <table class="table table-no-margin">
            <tbody style="font-size:12px">
                <tr>
                    <td style=""><strong>FULL NAME: </strong> {{$candidates->name}}</td>
                    <td style=""><strong>EMAIL ADDRESS:</strong>{{$candidates->email}}</td>
                    <td style=""><strong>PHONE NUMBER: </strong> {{$candidates->phone}}</td>
                    <td style=""><strong>CV/RESUME: </strong> <a href="/{{ $candidates->cv }}" target="_blank">
                            <i class="fa fa-fw fa-download"></i> DOWNLOAD</a></td>
                    <td><strong>INTERVIEW STATUS: <span
                                class="badge bg-{{$label_color}}">{{$candidates->interviewed}}</span></strong>
                    </td>
                </tr>
                <tr>
                    <td style=""><strong>POSITION APPLIED: </strong> {{$candidates->opening_name}}</td>
                    <td style=""><strong>INTERVIEW DATE:</strong>{{$candidates->interview_date}}</td>
                    <td style=""><strong>INTERVIEW TIME: </strong> {{$candidates->interview_time}}</td>
                    <td><strong>MY RATING STATUS: <span
                                class="badge bg-{{$rating_status_color}}">{{$rating_status}}</span></strong>
                    </td>
                    {{-- <td><strong>SESSION STARTED: <span
                                class="badge bg-{{$session_label_color}}">{{$candidates->session_started}}</span></strong>
                    </td> --}}
                    <td style=""><strong>SESSION STARTED AT: </strong> {{ $candidates->session_started_at }}</td>
                </tr>
                <tr>
                    <td style=""><strong>SESSION ENDED AT:</strong>{{ $candidates->session_ended_at }}</td>
                    <td style="">
                        <strong>INTERVIEW DURARTION: </strong> 45 MINUTES</td>
                    <td style=""><strong>CREATED AT: </strong> {{$candidates->candidate_created_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Candidate Rating</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <div class="chart">
            <canvas id="barChart" style="height:350px"></canvas>
        </div>
    </div>
    <!-- /.box-body -->
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Panelists Ratings</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body  with-border">
        <div class="table-responsive">
            <table id="example2" class="table table-hover" style="font-size:13px">
                <thead>
                    <tr>
                        <th>
                            <center>Panelist Name</center>
                        </th>
                        <th>
                            <center>Total Marks</center>
                        </th>
                        <th>
                            <center>Overall Rating</center>
                        </th>
                        <th>
                            <center>Recommendation</center>
                        </th>
                        <th>
                            <center>Submitted At</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @if ($count !=0)
                    @foreach ($candidate_ratings as $item)
                    <tr>
                        <td>
                            <center>{{$item->panelist_name}}</center>
                        </td>
                        <td>
                            <center>{{$item->total_marks}}/<strong>{{ $item->full_marks }}</strong></center>
                        </td>
                        <td>
                            <center>{{$item->overall_rating_name}}</center>
                        </td>
                        <td>
                            <center>{{ $item->recommendation_name }}</center>
                        </td>
                        <td>
                            <center>{{ $item->created_at }}</center>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td>No records</td>
                    </tr>
                    @endif
                </tbody>
                @if ($count !=0)

                <tfoot>
                    <tr class="bg-gray font-17 footer-total text-center">
                        <td colspan="1" rowspan="1"><strong>Average Marks:</strong></td>
                        <td colspan="1"><span class="display_currency" data-currency_symbol="true">
                                <strong> {{ $item->avg_marks }} Marks</strong></span></td>
                        <td rowspan="1" colspan="4"></td>
                    </tr>
                </tfoot>
                @else

                <tfoot>

                </tfoot>
                @endif

            </table>
        </div>
    </div>
</div>
@include('candidates.modals.modal_add_rating')
@include('candidates.modals.modal_add_rating_senior')
@include('candidates.modals.modal_close_candidate_session')
@include('candidates.modals.modal_second_interview')
@include('candidates.modals.modal_offer_letter')
@stop
@section('css')
@stop
@section('js')

<script src="/js/Chart.js"></script>
<script>
    $(function () {
       
           $('input').keyup(function(){
        var rating_marks1 = Number($('#rating_marks1').val());
        var rating_marks2 = Number($('#rating_marks2').val());
        var rating_marks3 = Number($('#rating_marks3').val());
        var rating_marks4 = Number($('#rating_marks4').val());
        var rating_marks5 = Number($('#rating_marks5').val());
        var rating_marks6 = Number($('#rating_marks6').val());
        var rating_marks7 = Number($('#rating_marks7').val());
        var rating_marks8 = Number($('#rating_marks8').val());
        var rating_marks9 = Number($('#rating_marks9').val());
        var rating_marks10 = Number($('#rating_marks10').val());
        var rating_marks11 = Number($('#rating_marks11').val());
        var rating_marks12 = Number($('#rating_marks12').val());
        var rating_marks13 = Number($('#rating_marks13').val());
        var rating_marks14 = Number($('#rating_marks14').val());
        var rating_marks15 = Number($('#rating_marks15').val());
        var rating_marks16 = Number($('#rating_marks16').val());

        var total_marks = rating_marks1 + rating_marks2 + rating_marks3 + rating_marks4 + rating_marks5 + rating_marks6 + 
        rating_marks7 + rating_marks8 + rating_marks9 + rating_marks10 + rating_marks11 + rating_marks12 + rating_marks13 + 
        rating_marks14 + rating_marks15 + rating_marks16;

        document.getElementById('total_marks').value = total_marks;
        });
        });
      
    $(function () {
    "use strict";

var ratings = <?php echo json_encode($candidate_ratings); ?>;
console.log(ratings);

var datasets = [];
for(var i=0; i< ratings.length; i++) {
    var rating = ratings[i];
 
   var color = getRandomColor();
    //alert(color);
    //rating.ratings
    var dataset = {
            label : rating.panelist_name,
            fillColor : color,
            strokeColor : color,
            pointColor : color,
            gridLines:false,
            pointStrokeColor : '#c1c7d1',
            pointHighlightFill : '#fff',
            pointHighlightStroke: 'rgba(220,220,220,1)',
            data : JSON.parse(rating.ratings)
        };
        datasets.push(dataset);
}
console.log(datasets);
var areaChartData = {
labels : ['Dress up', 'Composure', 'Attitude', 'Motivation', 'Communication', 'Assertiveness', 'Persuasiveness','Professional', 'Experience', 'Comp. Proficiency', 
'Technical Skills', 'Business Knowledege', 'Clarity of thought', 'Job Knowledge', 'Response to questions', 'Logic'],
datasets: datasets
};

//-------------
//- BAR CHART -
//-------------
var barChartCanvas = $('#barChart').get(0).getContext('2d')
var barChart = new Chart(barChartCanvas)
var barChartData = areaChartData
// barChartData.datasets[1].fillColor = '#00a65a'
// barChartData.datasets[1].strokeColor = '#00a65a'
// barChartData.datasets[1].pointColor = '#00a65a'
var barChartOptions = {
//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
scaleBeginAtZero : true,
//Boolean - Whether grid lines are shown across the chart
scaleShowGridLines : false,
//String - Colour of the grid lines
scaleGridLineColor : 'rgba(0,0,0,.05)',
//Number - Width of the grid lines
scaleGridLineWidth : 1,
//Boolean - Whether to show horizontal lines (except X axis)
scaleShowHorizontalLines: true,
//Boolean - Whether to show vertical lines (except Y axis)
scaleShowVerticalLines : true,
//Boolean - If there is a stroke on each bar
barShowStroke : true,
//Number - Pixel width of the bar stroke
barStrokeWidth : 2,
//Number - Spacing between each of the X value sets
barValueSpacing : 5,
//Number - Spacing between data sets within X values
barDatasetSpacing : 1,
//String - A legend template
legendTemplate : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
//Boolean - whether to make the chart responsive
responsive : true,
maintainAspectRatio : true
}

barChartOptions.datasetFill = false
barChart.Bar(barChartData, barChartOptions)
  })
  function getRandomColor() {
var letters = '0123456789ABCDEF';
var color = '#';
for (var i = 0; i < 6; i++) { color +=letters[Math.floor(Math.random() * 16)]; } return color; }
</script>
@stop