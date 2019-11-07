@extends('adminlte::page')
@section('title', 'Manage Department | Wananchi Group HR Recruitment')
@section('content_header')
<h1 class="pull-left"><b>#Department - {{$departments->department_name}}</b></h1>
<div style="clear:both"></div>
@stop
@section( 'content')
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Department Details</b></h3>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="ticketDetailsTable" class="table table-no-margin">
                    <tbody>
                        <tr>
                            <td><b>Department Name</b></td>
                            <td><span style="font-weight:bold">{{ $departments->department_name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Country</b></td>
                            <td><span style="font-weight:bold">{{ $departments->country_name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Total Jobs</b></td>
                            <td><span style="font-weight:bold">16 Job Postings</span></td>
                        </tr>
                        <tr>
                            <td><b>Created At</b></td>
                            <td><span style="font-weight:bold">{{ $departments->department_created_at}}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Functional Head(s)</b></h3>

            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table id="example6" class="table table-hover" style="font-size:12px">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Full Name</th>
                                <th>Email Address</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments->functional_heads_data as $count => $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->functional_head_created_at}}</td>
                                <td>
                                <td>
                                    <a class="btn btn-info btn-sm" title="Edit User" href="#" data-toggle="modal"
                                        data-target="#modal_edit_functional_head_{{$item->user_id}}"
                                        data-backdrop="static" data-keyboard="false"><i
                                            class="fa fa-pencil"></i>Edit</a>

                                    <a class="btn btn-danger btn-sm" title="Delete User" href="#" data-toggle="modal"
                                        data-target="#modal_delete_department_{{$item->user_id}}" data-backdrop="static"
                                        data-keyboard="false"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @include('departments.modals.modal_edit_functional_head')
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
@stop
@section('css')

@stop
@section('js')
<script>
    $(function () {
        $('#example6').DataTable();
        }); 
</script>
@stop