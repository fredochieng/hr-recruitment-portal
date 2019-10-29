@extends('adminlte::page')
@section('title', 'Manage Job Posting | Wananchi Group HR Recruitment')
@section('content_header')
<h1 class="pull-left"><b>#{{$job_postings->opening_ticket}} - {{$job_postings->opening_name}}</b></h1>
<div style="clear:both"></div>
@stop
@section( 'content')
<div class="row">
    <div class="col-md-5">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title"><b>Job Posting Details</b></h3>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="ticketDetailsTable" class="table table-no-margin">
                    <tbody>
                        <tr>
                            <td><b>Job Ticket #</b></td>
                            <td><span style="font-weight:bold">{{ $job_postings->opening_ticket}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Opening Name</b></td>
                            <td><span style="font-weight:bold">{{ $job_postings->opening_name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Job Status</b></td>
                            <td><span
                                    class="badge bg-{{$job_postings->label_color}}">{{$job_postings->status_name}}</span>
                            </td>
                        </tr>

                        <tr>
                            <td><b>Opening Type</b></td>
                            <td><span style="font-weight:bold">{{ $job_postings->type_name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Country</b></td>
                            <td><span style="font-weight:bold">{{ $job_postings->country_name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Department</b></td>
                            <td><span style="font-weight:bold">{{ $job_postings->department_name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Number of Candidates</b></td>
                            <td><span style="font-weight:bold">{{ $job_postings->no_of_candidates}} Candidate(s)</span>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Interview Status</b></td>
                            <td><span class="badge bg-{{$label_color}}">{{$interview_status}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Created By</b></td>
                            <td><span style="font-weight:bold">{{ $job_postings->name}}</span></td>
                        </tr>
                        <tr>
                            <td><b>Created At</b></td>
                            <td><span style="font-weight:bold">{{ $job_postings->posting_created_at}}</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-7">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab-edit-asset" data-toggle="tab" class="ticket-tab-button"
                        aria-expanded="true">Edit
                        Job Posting</a></li>

                <div class="btn-group pull-right" style="padding:6px;">
                    @if($job_postings->opening_status == 1 && $func_heads == 'N')
                    <a href="#" data-toggle="modal" data-target="#modal_add_interview_{{$job_postings->job_opening_id}}"
                        class="btn btn-info btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>Add
                        Functional Head
                    </a>
                    @endif
                    @if ($job_postings->opening_status == 1 && $interview_status == 'Not Created Yet' && $func_heads
                    == 'N')
                    <a href="#" data-toggle="modal" disabled
                        data-target="#modal_add_interviewsss_{{$job_postings->job_opening_id}}"
                        class="btn btn-primary btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i> Create Job
                        Interview</a>
                    @elseif ($job_postings->opening_status == 1 && $interview_status == 'Not Created Yet' ||
                    $interview_status == 'Deleted' &&
                    $func_heads
                    == 'Y')
                    <a href="#" data-toggle="modal" data-target="#modal_add_interview_{{$job_postings->job_opening_id}}"
                        class="btn btn-primary btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i> Create
                        Job
                        Interview</a>

                    @endif

                </div>

            </ul>
            <div class="tab-content">

                <div class="tab-pane active" id="tab-edit-asset">
                    <div class="row">

                        {!!
                        Form::open(['action'=>['JobPostingsController@updateJobPosting',$job_postings->job_opening_id],'method'=>'POST','class'=>'form','enctype'=>'multipart/form-data'])
                        !!}
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Job Opening Ticket')}}<br>
                                <div class="form-group">
                                    {{Form::text('asset_no', $job_postings->opening_ticket,['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Job Opening Name')}}<br>
                                <div class="form-group">
                                    {{Form::text('opening_name', $job_postings->opening_name,['class'=>'form-control', 'required', 'placeholder'=>''])}}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Job Type')}}<br>
                                <div class="form-group">
                                    <select class="form-control select2" name="posting_type_id" style="width: 100%;">
                                        <option value="{{ $job_postings->opening_type }}" selected="selected">
                                            {{$job_postings->type_name}}</option>
                                        @foreach($job_types as $item)
                                        <option value="{{ $item->id }}">{{ $item->type_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Country')}}<br>
                                <div class="form-group">
                                    <select class="form-control select2" name="country_id" id="countries" required
                                        style="width: 100%;">
                                        <option value="{{ $job_postings->country_id }}" selected="selected">
                                            {{$job_postings->country_name}}</option>
                                        @foreach($countries as $item)
                                        <option value="{{ $item->id }}">{{ $item->country_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Department</label>
                                <select class="form-control select2" name="department_id" id="departments" required
                                    style="width: 100%;" tabindex="-1" aria-hidden="true">
                                    <option value="{{ $job_postings->department_id }}" selected="selected">
                                        {{$job_postings->department_name}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Number of Candidates Needed')}}<br>
                                <div class="form-group">
                                    {{Form::number('no_of_candidates', $job_postings->no_of_candidates,['class'=>'form-control', 'min'=>'1', 'required', 'placeholder'=>''])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Created By')}}<br>
                                <div class="form-group">
                                    {{Form::text('created_by_name', $job_postings->name,['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{Form::label('Created At')}}<br>
                                <div class="form-group">
                                    {{Form::text('created_at', $job_postings->posting_created_at,['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                                </div>
                            </div>
                        </div>


                        <div class="col-md-3 pull-right">
                            <button type="submit" style="margin-top:25px;" class="btn btn-block btn-success"><strong><i
                                        class="fa fa-fw fa-save"></i>Save
                                    Changes</strong></button>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@include('jobs.modals.modal_add_interview')
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
            })

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
           
</script>
@stop