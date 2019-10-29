<div class="modal fade in" id="modal_edit_interview_{{ $interviews->interview_id }}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:60%">
        <div class="modal-content">
            {!!
            Form::open(['action'=>['InterviewsController@updateInterview',$interviews->interview_id],'method'=>'POST','class'=>'form','enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Interview</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="interview_id" value="{{ $interviews->interview_id }}" {{ csrf_field() }}
                        <div class="table-responsive">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{Form::label('Job Interview Name')}}<br>
                            <div class="form-group">
                                {{Form::text('interview_name', $interviews->interview_name,['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{Form::label('Functional Head')}}<br>
                            <div class="form-group">
                                {{Form::text('created_at', 'Fredrick Ochieng',['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Interview Date *') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{Form::text('interview_date', $interviews->interview_date, ['class' => 'form-control date_selector', 'id' => 'interview_date', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Interview Start Time *') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-clock"></i>
                                </span>
                                {{Form::text('interview_start_time', $interviews->interview_time, ['class' => 'form-control timepicker', 'id' => 'interview_start_time', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{Form::label('Started At')}}<br>
                            <div class="form-group">
                                {{Form::text('started_at', '2019-10-01 09:30:23',['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{Form::label('Ended At At')}}<br>
                            <div class="form-group">
                                {{Form::text('ended_at', '2019-10-01 15:45:57',['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{Form::label('Created By')}}<br>
                            <div class="form-group">
                                {{Form::text('created_by_name', $interviews->name,['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {{Form::label('Created At')}}<br>
                            <div class="form-group">
                                {{Form::text('created_at', $interviews->interview_created_at,['class'=>'form-control', 'readonly', 'placeholder'=>''])}}
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-check"></i> Save
                Changes</button>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.modal-content -->
</div>
</div>