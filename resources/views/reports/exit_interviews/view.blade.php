@extends('adminlte::page')
@section('title', 'Exit Interviews Report | Wananchi Group HR Recruitment')
@section('content_header')
<h1>Exit Interviews Report</h1>
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
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! Form::label('Country') !!}
                                <div class="form-group">
                                    {{Form::text('opening_name', $country_name, ['class' => 'form-control', 'readonly' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Department') !!}
                                <div class="form-group">
                                    {{Form::text('opening_name', $department_name, ['class' => 'form-control', 'readonly' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Exit Creation Date') !!}
                                {!! Form::text('date_range', $start_date. '-'. $end_date, ['placeholder' => 'Select date
                                range', 'class' =>
                                'form-control', 'id' => 'daterange-btn', 'readonly']); !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <a href="/reports/exit_interviews" style="margin-top:25px;"
                                class="btn bg-purple pull-right"><strong><i class="fa fa-arrow-left"></i>
                                    BACK</strong></a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-body">
                <div class="table-responsive">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <b>Exit Interviews Report For Period</b>
                            {{$start_date}} - {{$end_date}}</h3>

                        <a href="/report/jobs/excel/generate?date_range=<?php echo $start_date .' - '. $end_date ?>&country_id=<?php echo $country_id ?>&department_id=<?php echo $department_id ?>"
                            class="btn btn-info btn-flat pull-right"><strong>EXPORT
                                TO EXCEL</strong></a>
                    </div>
                    <table id="example1" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Employee No</th>
                                <th>Current Position</th>
                                <th>Country</th>
                                <th>Department</th>
                                <th>Start Date</th>
                                <th>Exit Date</th>
                                <th>Supervisor</th>
                                <th>Interviewed By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exit_interviews as $item)
                            <tr>
                                <td>{{$item->employee_name}}</td>
                                <td>{{$item->employee_no}}</td>
                                <td>{{$item->current_position}}</td>
                                <td>{{$item->country_name}}</td>
                                <td>{{$item->department_name}}</td>
                                <td>{{$item->start_date}}</td>
                                <td>{{$item->exit_date}}</td>
                                <td>{{$item->supervisor}}</td>
                                <td>{{$item->interviewed_by_name}}</td>
                                <td>{{$item->exit_interview_created_at}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @stop
    @section('css')

    @stop
    @section('js')

    <script type="text/javascript">
        $(".select2").select2();
    $('#example1').DataTable()
    </script>
    @stop