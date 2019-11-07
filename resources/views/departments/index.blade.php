@extends('adminlte::page')

@section('title', 'Departments | Wananchi Group HR Recruitment')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Departments</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_department" data-toggle="modal" class="btn btn-primary"
                data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> New Department </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive">
            <table id="example5" class="table table-hover">
                <thead>
                    <tr>
                        <th>S/N</th>
                        <th>Department Name</th>
                        <th>Country Name</th>
                        <th>Functional Heads</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($departments as $count => $item)
                    <tr>
                        <td>{{ $count + 1 }}</td>
                        <td>{{$item->department_name}}</td>
                        <td>{{$item->country_name}}</td>
                        <td><a href="" data-toggle="modal"
                                data-target="#modal_show_functional_heads_{{ $item->department_id }}"><strong>
                                    View Functional Head
                                </strong></a>
                        </td>
                        <td>{{$item->department_created_at}}</td>
                        <td>
                        <td> <a href="/department/manage/&id={{$item->department_id}}"
                                class="btn btn-flat btn-info btn-sm"><i class="fa fa-eye"></i></a>
                            <a href="#" data-target="#modal_edit_department_{{ $item->department_id }}"
                                data-toggle="modal" class="btn btn-flat btn-info
                            btn-sm" data-backdrop="static" data-keyboard="false"><i class="fa fa-pencil-square-o"></i>
                                Edit
                            </a>
                            <a class="btn btn-danger btn-sm" title="Delete Department" href="#" data-toggle="modal"
                                data-target="#modal_delete_department_{{$item->department_id}}" data-backdrop="static"
                                data-keyboard="false"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @include('departments.modals.modal_edit_department')
                    @include('departments.modals.modal_delete_department')
                    @include('departments.modals.modal_show_functional_heads')
                    @endforeach
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