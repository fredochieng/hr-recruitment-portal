<div class="modal fade" id="modal_close_candidate_session_{{ $candidates->candidate_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            {!!
            Form::open(['action'=>['InterviewsController@closeCandidateSession',$candidates->candidate_id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
            !!} {{Form::hidden('_method','DELETE')}}

            <input type="hidden" name="candidate_id" value="{{ $candidates->candidate_id }}">
            <input type="hidden" name="interview_id" value="{{ $candidates->interview_id }}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Close Interview Session</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Are you sure you want to close the interview session for <span
                                style="font-weight:bold">{{$candidates->name}}</span>?
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i>
                    No</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Yes, close</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>