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
                            <div class="form-group">
                                {!! Form::label('Job Status') !!}
                                <div class="form-group">
                                    {{Form::text('opening_name', $status_name, ['class' => 'form-control', 'readonly' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Country') !!}
                                <div class="form-group">
                                    {{Form::text('opening_name', $country_name, ['class' => 'form-control', 'readonly' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Department') !!}
                                <div class="form-group">
                                    {{Form::text('opening_name', $department_name, ['class' => 'form-control', 'readonly' ])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Job Creation Date') !!}
                                {!! Form::text('date_range', $start_date. '-'. $end_date, ['placeholder' => 'Select date
                                range', 'class' =>
                                'form-control', 'id' => 'daterange-btn', 'readonly']); !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <a href="/reports/jobs" style="margin-top:25px;" class="btn bg-purple pull-right"><strong><i
                                        class="fa fa-arrow-left"></i>
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
                            <b>Job Postings Report For Period</b>
                            {{$start_date}} - {{$end_date}}</h3>

                        <a href="/report/jobs/excel/generate?date_range=<?php echo $start_date .' - '. $end_date ?>&status_id=<?php echo $status_id ?>&country_id=<?php echo $country_id ?>&department_id=<?php echo $department_id ?>"
                            class="btn btn-info btn-flat pull-right"><strong>EXPORT
                                TO EXCEL</strong></a>
                    </div>
                    <table id="example1" class="table table-hover" style="font-size:13px">
                        <thead>
                            <tr>
                                <th>Opening Ticket</th>
                                <th>Opening Name</th>
                                <th>Opening Type</th>
                                <th>Status</th>
                                <th>Country</th>
                                <th>Department</th>
                                <th>Created By</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $item)
                            <tr>
                                <td>{{$item->opening_ticket}}</td>
                                <td>{{$item->opening_name}}</td>
                                <td>{{$item->type_name}}</td>
                                <td><span class="pull-right-container"><small
                                            class="badge bg-{{ $item->label_color }}">{{$item->status_name}}</small></span>
                                </td>
                                <td>{{$item->country_name}}</td>
                                <td>{{$item->department_name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->posting_created_at}}</td>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
    @stop
    @section('js')

    <script type="text/javascript">
        $(".select2").select2();
    $('#example1').DataTable()
    </script>
    @stop