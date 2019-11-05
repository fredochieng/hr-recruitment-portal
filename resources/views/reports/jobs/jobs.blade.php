@extends('adminlte::page')
@section('title', 'Jobs Posting Report | Wananchi Group HR Recruitment')
@section('content_header')
<h1>Jobs Posting Report</h1>
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-info" id="accordion">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseFilter">
                        <i class="fa fa-filter" aria-hidden="true"></i> Filters
                    </a>
                </h3>
            </div>
            <div id="collapseFilter" class="panel-collapse active collapse in" aria-expanded="true">
                <div class="box-body">
                    {!!
                    Form::open(['action'=>['ReportsController@jobsReport'],
                    'method'=>'POST','class'=>'form','enctype'=>'multipart/form-data'])
                    !!}
                    <div class="col-md-12">
                        <div class="col-md-3">
                            {{Form::label('Job Status')}}
                            <div class="form-group">
                                <select class="form-control select2" id="status_id" name="status_id" required
                                    style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option selected="selected" value="">Select job status</option>
                                    @foreach($job_status as $item)
                                    <option value="{{ $item->id }}">{{ $item->status_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            {{Form::label('Country ')}}
                            <div class="form-group">
                                <select class="form-control select2" name="country_id" id="countries" required
                                    style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="">Select country</option>
                                    @foreach($countries as $item)
                                    <option value='{{ $item->id }}'>{{ $item->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control select2" name="department_id" id="departments"
                                    style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="0" disabled="true" selected="true">Select country first</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Date Range') !!}
                                {!! Form::text('date_range', null, ['placeholder' => 'Select date range', 'class' =>
                                'form-control', 'id' => 'daterange-btn', 'readonly']); !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" style="margin-top:25px;"
                                class="btn btn-block btn-info pull-right"><strong><i
                                        class="fa fa-fw fa-search"></i>Generate Report</strong></button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

@stop
@section('css')
<link rel="stylesheet" href="/plugins/bootstrap-daterangepicker/daterangepicker.css">
@stop
@section('js')
<script src="/plugins/jquery/dist/jquery.js"></script>
<script src="/plugins/moment/min/moment.min.js"></script>
<script src="/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script>
    $(function () {
     //Date range as a button
     $('#daterange-btn').daterangepicker(
       {
         ranges   : {
           'Today'       : [moment(), moment()],
           'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month'  : [moment().startOf('month'), moment().endOf('month')],
           'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
         },
         startDate: moment().subtract(29, 'days'),
         endDate  : moment()
       },
       function (start, end) {
         $('#daterange-btn span').html(start.format('YYYY, MMMM, D') + ' - ' + end.format('YYYY, MMMM, D'))
       }
     )

     var start = "";
     var end = "";
     if ($("input#daterange-btn").val()) {
         start = $("input#daterange-btn")
             .data("daterangepicker")
             .startDate.format("YYYY-MM-DD");
         end = $("input#daterange-btn")
             .data("daterangepicker")
             .endDate.format("YYYY-MM-DD");
     }
     start_date = start;
     end_date = end;
   })
</script>
<script>
    $(function () {

          $('#countries').on('change', function(e){
        console.log(e);
        var country_id = e.target.value;
        $.get('/get_departments?country_id=' + country_id,function(data) {
        console.log(data);
        $('#departments').empty();
        $('#departments').append('<option value="0" disable="true" selected="true">Select department</option>');
        
        $.each(data, function(index, departmentsObj){
        $('#departments').append('<option value="'+ departmentsObj.id +'">'+
            departmentsObj.department_name +'</option>');
        })
        });
        });
 });
</script>
@stop