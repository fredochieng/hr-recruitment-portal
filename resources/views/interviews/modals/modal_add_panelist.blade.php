<div class="modal fade" id="modal_add_panelist_{{ $interviews->interview_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            {!!
            Form::open(['action'=>['InterviewsController@addPanelist',$interviews->interview_id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
            !!}

            <input type="hidden" name="interview_id" value="{{ $interviews->interview_id }}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Interview Panelist</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('Panelist Name *') !!}
                                <div class="form-group">
                                    {{Form::text('panelist_name', null, ['class' => 'form-control', 'required', 'Placeholder' => 'Enter panelist\'s name'])}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label('Panelist Email *') !!}
                                <div class="form-group">
                                    {{Form::email('panelist_email', null, ['class' => 'form-control', 'required', 'Placeholder' => 'Enter panelist\'s email'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i>
                    No</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Add Panelist</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>