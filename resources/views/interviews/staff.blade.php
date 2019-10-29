@extends('adminlte::page')

@section('title', 'Closed Job Interviews | Wananchi Group HR Recruitment')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Closed Job Interviews</h3>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="example2" class="table table-hover">
                <thead>
                    <tr>
                        <th>Job Ticket</th>
                        <th>Job Name</th>
                        <th>Interview Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($interviews as $item)
                    <tr>
                        <td>
                            <a href="/job/manage/&id={{$item->job_opening_id}}">{{$item->opening_ticket}}</a>

                        </td>
                        <td>{{$item->opening_name}}</td>
                        <td>{{$item->interview_name}}</td>
                        <td><span class="pull-right-container"><small
                                    class="badge bg-{{ $item->label_color }}">{{$item->status_name}}</small></span></td>
                        <td>{{$item->interview_date}}</td>
                        <td>{{$item->interview_time}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->interview_created_at}}</td>
                        <td>
                            <a href="/interview/manage/&id={{$item->interview_id}}" class="btn btn-flat btn-info
                        btn-sm"><i class="fa fa-eye"></i></a>

                            @if ($item->interview_status == 3)
                            <a class="btn btn-danger btn-sm disabled" title="Delete Job Interview" href="#"
                                data-toggle="modal" data-target="#modal_delete_interview_{{$item->interview_id}}"
                                data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></a>
                            @else
                            <a class="btn btn-danger btn-sm" title="Delete Job Interview" href="#" data-toggle="modal"
                                data-target="#modal_delete_interview_{{$item->interview_id}}" data-backdrop="static"
                                data-keyboard="false"><i class="fa fa-trash"></i></a>
                            @endif

                        </td>
                    </tr>
                    @include('interviews.modals.modal_delete_interview')
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
<script src="/js/dataTable.js"></script>

@stop