@extends('adminlte::page')

@section('title', 'Manage Interview | Wananchi Group HR Recruitment')

@section('content_header')
<h1><strong>{{$interviews->interview_name}}</strong>
    <p class="pull-right">
        <a href="#" data-toggle="modal" data-target="#modal_edit_interview_{{ $interviews->interview_id }}"
            class="btn btn-primary btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            EDIT INTERVIEW</a>

        @if ($interviews->interview_status == 2)
        <a href="#" data-toggle="modal" data-target="#modal_selected_candidates_{{$interviews->interview_id}}"
            class="btn btn-warning btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            SELECTED CANDIDATES</a>
        @endif
        @if ($interviews->interview_status == 1)
        <a href="#" data-toggle="modal" data-target="#modal_add_candidates_{{$interviews->interview_id}}"
            class="btn btn-info btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            ADD CANDIDATES</a>
        @else
        <a href="#" data-toggle="modal" disabled data-target="#modal_add_candidatessss_{{$interviews->interview_id}}"
            class="btn btn-info btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            ADD CANDIDATES</a>
        @endif

        @if ($interviews->interview_status == 1)
        <a href="#" data-toggle="modal" data-target="#modal_add_panelist_{{$interviews->interview_id}}"
            class="btn btn-warning btn-sm btn-flat"><i class="fas fa-fw fa-plus-circle"></i>
            ADD PANELIST</a>
        @endif

        @if ($interviews->interview_status == '1' && count($candidates) > 0)

        <a href="#" data-toggle="modal" data-target="#modal_start_session_{{ $interviews->interview_id }}"
            class="btn btn-success btn-sm btn-flat"><i class="fas fa-fw fa-bolt"></i>
            START SESSION</a>
        @else
        <a href="#" data-toggle="modal" disabled data-target="#modal_start_sessionsss_{{ $interviews->interview_id }}"
            class="btn btn-success btn-sm btn-flat"><i class="fas fa-fw fa-bolt"></i>
            START SESSION</a>
        @endif
        @if ($interviews->interview_status == '4')

        <a href="#" data-toggle="modal" data-target="#modal_close_session_{{ $interviews->interview_id }}"
            class="btn btn-danger btn-sm btn-flat"><i class="fas fa-fw fa-check"></i>
            CLOSE SESSION</a>
        @endif
    </p>
</h1>
@stop

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"></h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body  with-border">
        <table class="table table-no-margin">
            <tbody style="font-size:12px">
                <tr>
                    <td style=""><strong>INTERVIEW NAME: </strong> {{$interviews->interview_name}}</td>
                    <td style=""><strong>POSITION: </strong> {{$interviews->opening_name}}</td>
                    <td><strong>INTERVIEW STATUS: <span
                                class="badge bg-{{$interviews->label_color}}">{{$interviews->status_name}}</span></strong>
                    </td>
                    <td style=""><strong>OPENING TYPE: </strong> {{$interviews->type_name}}</td>
                    <td style=""><strong>COUNTRY: </strong> {{$interviews->country_name}}</td>
                </tr>
                <tr>
                    <td style=""><strong>DEPARTMENT: </strong> {{$interviews->department_name}}</td>
                    <td style=""><strong>FUNCTIONAL HEAD: </strong> {{ $functional_head->functional_head_name }}</td>
                    <td style=""><strong>NUMBER OF CANDIDATES: </strong> {{$interviews->no_of_candidates}} Candidates
                    </td>
                    <td style=""><strong>INTERVIEW DATE: </strong> {{$interviews->interview_date}}</td>
                    <td style=""><strong>START TIME: </strong> {{$interviews->interview_time}}</td>
                </tr>
                <tr>
                    @if ($interviews->started_at != '')
                    <td style=""><strong>STARTED AT: </strong> {{$interviews->started_at}}</td>
                    @else
                    <td style=""><strong>STARTED AT: </strong> NOT STARTED</td>
                    @endif
                    @if ($interviews->started_at != '' && $interviews->ended_at == '')
                    <td style=""><strong>ENDED AT: </strong>STILL ONGOING</td>
                    @elseif($interviews->ended_at != '')
                    <td style=""><strong>ENDED AT: </strong> {{$interviews->ended_at}}</td>
                    @elseif($interviews->started_at == '' && $interviews->ended_at == '')
                    <td style=""><strong>ENDED AT: </strong>NOT STARTED</td>
                    @endif
                    <td style=""><strong>FULL NAME: </strong> {{$interviews->interview_name}}</td>
                    <td style=""><strong>CREATED BY: </strong> {{$interviews->name}}</td>
                    <td style=""><strong>CREATED AT: </strong> {{$interviews->interview_created_at}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Selected Candidates</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body  with-border">
        <div class="table-responsive">
            <table id="example2" class="table table-hover" style="font-size:13px">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>CV File</th>
                        <th>Interview Status</th>
                        <th>Start Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($candidates as $item)
                    <tr>
                        <td>{{$item->name}}</td>
                        <td>{{$item->email}}</td>
                        <td>{{$item->phone}}</td>
                        <td><a href="/{{$item->cv}}" target="_blank"><i class="fa fa-fw fa-download"></i>
                                Download</a></td>
                        @if ($item->interviewed == 'PENDING')
                        <td><span class="badge bg-yellow">{{$item->interviewed}}</span></td>
                        @elseif($item->interviewed == 'ONGOING')
                        <td><span class="badge bg-aqua">{{$item->interviewed}}</span></td>
                        @elseif($item->interviewed == 'CLOSED')
                        <td><span class="badge bg-green">{{$item->interviewed}}</span></td>
                        @endif
                        <td>{{ $item->interview_time }}</td>
                        <td>
                            <a href="/candidate/manage/&id={{$item->candidate_id}}" target="_blank"
                                class="btn btn-flat btn-info btn-sm"><i class="fa fa-eye"></i></a>
                            @if ($item->interviewed == 'PENDING' && $interviews->interview_status == '4' )
                            <a class="btn btn-primary btn-sm" title="Start Session" href="#" data-toggle="modal"
                                data-target="#modal_start_candidate_session_{{$item->candidate_id}}"
                                data-backdrop="static" data-keyboard="false"><i class="fa fa-bolt"></i></a>
                            @else
                            <a class="btn btn-primary btn-sm" disabled title="Start Session" href="#"
                                data-toggle="modal"
                                data-target="#modal_start_candidate_sessionddd_{{$item->candidate_id}}"
                                data-backdrop="static" data-keyboard="false"><i class="fa fa-bolt"></i></a>
                            @endif

                            <a class="btn btn-danger btn-sm" title="Delete Candidate" href="#" data-toggle="modal"
                                data-target="#modal_delete_candidate_{{$item->candidate_id}}" data-backdrop="static"
                                data-keyboard="false"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @include('interviews.modals.modal_delete_candidate')
                    @include('interviews.modals.modal_start_candidate_session')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">All Panelists Ratings</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body  with-border">
        <div class="table-responsive">
            <table id="example2" class="table table-hover" style="font-size:13px">
                <thead>
                    <tr>
                        <th>
                            <center>Panelist Name</center>
                        </th>
                        <th>
                            <center>Candidate Name</center>
                        </th>
                        <th>
                            <center>Total Marks</center>
                        </th>
                        <th>
                            <center>Overall Rating</center>
                        </th>
                        <th>
                            <center>Recommendation</center>
                        </th>
                        <th>
                            <center>Submitted At</center>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ratings as $item)
                    <tr>
                        <td>
                            <center>{{$item->panelist_name}}</center>
                        </td>
                        <td>
                            <center>{{$item->candidate_name}}</center>
                        </td>
                        <td>
                            <center>{{$item->total_marks}}/<strong>{{ $item->full_marks }}</strong></center>
                        </td>
                        <td>
                            <center>{{$item->overall_rating_name}}</center>
                        </td>
                        <td>
                            <center>{{ $item->recommendation_name }}</center>
                        </td>
                        <td>
                            <center>{{ $item->created_at }}</center>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @if ($ratings_available == 'Y')
                    <tr class="bg-gray font-17 footer-total text-center">
                        <td colspan="1" rowspan="1"><strong>Average Marks:</strong></td>
                        <td colspan="3"><span class="display_currency" data-currency_symbol="true">
                                <strong> {{ $item->avg_marks }} Marks</strong></span></td>
                        <td rowspan="1" colspan="4"></td>
                    </tr>
                    @else

                    @endif
                </tfoot>

            </table>
        </div>
    </div>
</div>
@stop
@include('interviews.modals.modal_edit_interview')
@include('interviews.modals.modal_add_candidates')
@include('interviews.modals.modal_add_panelist')
@include('interviews.modals.modal_start_session')
@include('interviews.modals.modal_close_session')
@include('interviews.modals.modal_selected_candidates')
@section('css')
<link rel="stylesheet" href="/css/bootstrap-datepicker.min.css">
<link rel="stylesheet" href="/css/bootstrap-timepicker.min.css">
@stop
@section('js')
<script src="/js/bootstrap-datepicker.min.js"></script>
<script src="/js/bootstrap-timepicker.min.js"></script>
<script src="/js/dataTable1.js"></script>
<script src="/js/add_candidate.js"></script>
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
      
</script>
@stop