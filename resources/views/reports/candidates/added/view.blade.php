@extends('adminlte::page')
@section('title', 'Added Candidates Report | Wananchi Group HR Recruitment')
@section('content_header')
<h1>Added Candidates Report</h1>
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
                    {!! !!}
                    Form::open(['action'=>['ReportsController@jobsReport'],
                    'method'=>'POST','class'=>'form','enctype'=>'multipart/form-data'])
                    !!}
                    <div class="col-md-12">
                        <div class="col-md-3">
                            <div class="form-group">
                                {!! Form::label('Interview Status') !!}
                                <div class="form-group">
                                    {{Form::text('opening_name', $interview_status, ['class' => 'form-control', 'readonly' ])}}
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
                                {!! Form::label('Interview Date') !!}
                                {!! Form::text('date_range', $start_date. '-'. $end_date, ['placeholder' => 'Select date
                                range', 'class' =>
                                'form-control', 'id' => 'daterange-btn', 'readonly']); !!}
                            </div>
                        </div>

                        <div class="col-md-2">
                            <a href="/reports/candidates/added" style="margin-top:25px;"
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
                            <b>Added candidates Report For Period</b>
                            {{$start_date}} - {{$end_date}}</h3>

                        <a href="/report/jobs/excel/generate?date_range=<?php echo $start_date .' - '. $end_date ?>&country_id=<?php echo $country_id ?>&department_id=<?php echo $department_id ?>"
                            class="btn btn-info btn-flat pull-right"><strong>EXPORT
                                TO EXCEL</strong></a>
                    </div>
                    <table id="example2" class="table table-hover" style="font-size:11px">
                        <thead>
                            <tr>
                                <th>Opening Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Interview Date</th>
                                <th>Interview Status</th>
                                <th>Start Time</th>
                                <th>Country</th>
                                <th>Department</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($added_candidates as $item)
                            <tr>
                                <td>{{$item->opening_name}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->phone}}</td>
                                <td>{{ $item->interview_date }}</td>
                                @if ($item->interviewed == 'PENDING')
                                <td><span class="badge bg-yellow">{{$item->interviewed}}</span></td>
                                @elseif($item->interviewed == 'ONGOING')
                                <td><span class="badge bg-aqua">{{$item->interviewed}}</span></td>
                                @elseif($item->interviewed == 'CLOSED')
                                <td><span class="badge bg-green">{{$item->interviewed}}</span></td>
                                @endif
                                <td>{{ $item->interview_time }}</td>
                                <td>{{ $item->country_name }}</td>
                                <td>{{ $item->department_name }}</td>
                                <td>{{ $item->candidate_created_at }}</td>
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
        $('#example2').DataTable()
    </script>
    @stop