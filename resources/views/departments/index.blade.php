@extends('adminlte::page')

@section('title', 'Departments | Wananchi Group HR Recruitment')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Departments</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_department" data-toggle="modal" class="btn btn-primary" data-backdrop="static"
                data-keyboard="false"><i class="fa fa-plus"></i> New Department </a>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($job_postings as $item)
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
                    <td> <a href="/job/manage/&id={{$item->job_opening_id}}" class="btn btn-flat btn-info btn-sm"><i
                                class="fa fa-eye"></i></a>

                        @if ($item->opening_status == 3)
                        <a class="btn btn-danger btn-sm disabled" title="Delete Job Opening" href="#"
                            data-toggle="modal" data-target="#modal_delete_job_{{$item->job_opening_id}}"
                            data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></a>
                        @else
                        <a class="btn btn-danger btn-sm" title="Delete Job Opening" href="#" data-toggle="modal"
                            data-target="#modal_delete_job_{{$item->job_opening_id}}" data-backdrop="static"
                            data-keyboard="false"><i class="fa fa-trash"></i></a>
                        @endif

                    </td>
                    </tr>
                    @include('jobs.modals.modal_delete_job')
                    @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

@include('departments.modals.modal_add_department')

@stop
@section('css')

@stop
@section('js')

<script>
    $(function () {
          $(".select2").select2()
          $('#example1').DataTable()

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