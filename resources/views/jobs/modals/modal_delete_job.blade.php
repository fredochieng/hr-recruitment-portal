<div class="modal fade" id="modal_delete_job_{{ $item->job_opening_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            {!!
            Form::open(['action'=>['JobPostingsController@destroy',$item->job_opening_id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
            !!} {{Form::hidden('_method','DELETE')}}

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete Job Posting</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Are you sure you want to delete <span
                                style="font-weight:bold">{{$item->opening_name}}</span>?
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i>
                    No</button>
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-check"></i> Yes, delete</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>