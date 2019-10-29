<div class="modal fade in" id="modal_add_interview_{{$job_postings->job_opening_id}}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!! Form::open(['url' => action('InterviewsController@store'), 'method' => 'post'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Job Interview</h4>
            </div>
            <input type="hidden" name="job_opening_id" value="{{ $job_postings->job_opening_id }}">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Interview Name *') !!}
                            <div class="form-group">
                                {{Form::text('interview_name', $interview_name, ['class' => 'form-control', 'id' => 'interview_name', 'required', 'readonly'])}}
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
                                {{Form::text('interview_date', null, ['class' => 'form-control date_selector', 'id' => 'interview_date', 'required' ])}}
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
                                {{Form::text('interview_start_time', null, ['class' => 'form-control timepicker', 'id' => 'interview_start_time', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Functional Head ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="functional_head_id" id="functional_head_id"
                                required style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Select functional head</option>
                                @foreach($functional_heads as $item)
                                <option value='{{ $item->id }}'>{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Create Job Interview</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>