@extends('adminlte::page')

@section('title', 'Exit Interviews | Wananchi Group HR Recruitment')

@section('content_header')
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Exit Interviews</h3>
        <div class="pull-right">
            <a href="#" data-target="#modal_add_exit_interview" data-toggle="modal" class="btn btn-primary"
                data-backdrop="static" data-keyboard="false"><i class="fa fa-plus"></i> New Exit Interview </a>
        </div>
    </div>

    <div class="box-body">
        <div class="table-responsive" style="font-size:11px">
            <table id="example1" class="table table-hover">
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
                        <th>Action</th>
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
                        <td>
                            @if ($item->deleted_at != '')
                            <a class="btn btn-danger btn-sm" title="Delete Exit Interview" href="#" data-toggle="modal"
                                disabled data-target="#modal_delete_exit_interview_{{$item->exit_interview_id}}"
                                data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></a>
                            @else
                            <a class="btn btn-danger btn-sm" title="Delete Exit Interview" href="#" data-toggle="modal"
                                data-target="#modal_delete_exit_interview_{{$item->exit_interview_id}}"
                                data-backdrop="static" data-keyboard="false"><i class="fa fa-trash"></i></a>
                            @endif
                        </td>
                    </tr>
                    @include('exit_interviews.modals.modal_delete_exit_interview')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.box-body -->
</div>

@include('exit_interviews.modals.modal_add_exit_interview')

@stop
@section('css')
<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/css/bootstrap-timepicker.min.css">
@stop
@section('js')
<script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/bootstrap-timepicker.min.js"></script>
<script>
    $(function () {
        //Timepicker
        $('.timepicker').timepicker({
        showInputs: false
        })
         $('.date_selector').datepicker( {
             format: 'yyyy-mm-dd',
            orientation: "bottom",
            autoclose: true,
             showDropdowns: true,
             todayHighlight: true,
             toggleActive: true,
             clearBtn: true,
         })
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