@extends('adminlte::page')

@section('title', 'Users | Wananchi Group HR Recruitment')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Users</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_department" data-toggle="modal" class="btn btn-primary"
                data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> New User </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="example5" class="table table-hover">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Full Name</th>
                        <th>Email Address</th>
                        <th>User Role</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $count => $item)
                    <tr>
                        <td>{{ $count + 1 }}</td>
                        <td>{{$item->user_name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->role_name}}</td>
                        <td>{{$item->user_created_at}}</td>
                        <td><a class="btn btn-danger btn-sm" title="Delete Department" href="#" data-toggle="modal"
                                data-target="#modal_delete_exit_interview_{{$item->user_id}}" data-backdrop="static"
                                data-keyboard="false"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

{{-- @include('departments.modals.modal_add_department') --}}


@stop
@section('css')

@stop
@section('js')
<script>
    $(function () {
          $(".select2").select2()
        
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

        $('#example5').DataTable({
        "pageLength": 10
        })
 });
</script>

@stop