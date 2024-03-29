@extends('adminlte::page')

@section('title', 'Deleted Job Postings | Wananchi Group HR Recruitment')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Deleted Job Postings</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_job" data-toggle="modal" class="btn btn-primary" data-backdrop="static"
                data-keyboard="false"><i class="fa fa-plus"></i> New Job Posting </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="example1" class="table table-hover">
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
                        <th>Deleted At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($job_postings as $item)
                    <tr>
                        <td>{{$item->opening_ticket}}</td>
                        <td>{{$item->opening_name}}</td>
                        <td>{{$item->type_name}}</td>
                        <td><span class="pull-right-container"><small
                                    class="badge bg-{{ $item->label_color }}">{{$item->status_name}}</small></span></td>
                        <td>{{$item->country_name}}</td>
                        <td>{{$item->department_name}}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$item->posting_created_at}}</td>
                        <td>{{$item->deleted_at}}</td>
                        <td> <a href="/job/manage/&id={{$item->job_opening_id}}" class="btn btn-flat btn-info btn-sm"><i
                                    class="fa fa-eye"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

@include('jobs.modals.modal_add_job')

@stop
@section('css')
{{-- <link rel="stylesheet" href="/css/bootstrap-datepicker.min.css"> --}}
@stop
@section('js')

{{-- <script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/select2.full.min.js"></script> --}}

<script>
    $(function () {
          $(".select2").select2()
          $('#example1').DataTable()
 })
</script>

@stop