@extends('adminlte::page')

@section('title', 'Deleted Exit Interviews | Wananchi Group HR Recruitment')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Deleted Exit Interviews</h3>
    </div>

    <div class="box-body">
        <div class="table-responsive" style="font-size:12px">
            <table id="example2" class="table table-hover">
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
                        <th>Deleted At</th>
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
                        <td>{{$item->deleted_at}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>
@stop
@section('css')

@stop
@section('js')
<script src="/js/dataTable1.js"></script>
@stop