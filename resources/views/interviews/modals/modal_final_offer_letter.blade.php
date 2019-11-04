<div class="modal fade" id="modal_final_offer_letter_{{ $item->cand_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            {!!
            Form::open(['action'=>['CandidateController@offerLetter',$item->cand_id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
            !!}

            <input type="hidden" name="interview_id" value="{{ $item->interview_id }}">
            <input type="hidden" name="candidate_id" value="{{ $item->cand_id }}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Proceed With Offer Letter</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p>Are you sure you want to proceed with offer letter for <span
                                style="font-weight:bold">{{$item->candidate_name}}</span>?
                        </p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i>
                    No</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Yes, proceed</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>