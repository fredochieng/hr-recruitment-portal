@extends('adminlte::page')
@section('title', 'Rated Candidates Report | Wananchi Group HR Recruitment')
@section('content_header')
<h1>Rated Candidates Report</h1>
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
                        <div class="col-md-2">
                            <div class="form-group">
                                {!! Form::label('Interview Date') !!}
                                {!! Form::text('date_range', $start_date. '-'. $end_date, ['placeholder' => 'Select date
                                range', 'class' =>
                                'form-control', 'id' => 'daterange-btn', 'readonly']); !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <a href="/reports/candidates/rated" style="margin-top:25px;"
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
                            <b>Rated candidates Report For Period</b>
                            {{$start_date}} - {{$end_date}}</h3>

                        <a href="/report/jobs/excel/generate?date_range=<?php echo $start_date .' - '. $end_date ?>&country_id=<?php echo $country_id ?>&department_id=<?php echo $department_id ?>"
                            class="btn btn-info btn-flat pull-right"><strong>EXPORT
                                TO EXCEL</strong></a>
                    </div>
                    <table id="example2" class="table table-hover" style="font-size:12px">
                        <thead>
                            <tr>
                                <th>Candidate Name</th>
                                <th>Candidate Email</th>
                                <th>Phone Number</th>
                                <th>Interviewed On</th>
                                <th>Interview Start Time</th>
                                <th>Interview End Time</th>
                                <th>Average Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rated_candidates as $count => $item)
                            <tr>
                                <td>{{ $item->candidate_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->candidate_interview_date }}</td>
                                <td>{{ $item->session_start_time }}</td>
                                <td>{{ $item->session_end_time }}</td>
                                <td><strong>{{ round($item->average_marks) }}/ 80 Marks</strong></td>
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
        $('#example2').DataTable();
    </script>
    @stop