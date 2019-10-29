<div class="modal fade in" id="modal_add_candidates_{{ $interviews->interview_id }}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            {!! Form::open(['url' => action('InterviewsController@addCandidates'), 'method' => 'post' , 'enctype' =>
            'multipart/form-data',
            'name'=>"add_name", 'id'=>"add_name"])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Candidate(s)</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" name="interview_id" value="{{ $interviews->interview_id }}" {{ csrf_field() }}
                        <div class="table-responsive">
                    <table class="table" id="dynamic_field">
                        <tr>
                            <td>
                                <input type="text" name="name[]" placeholder="Enter full name"
                                    class="form-control name_list" />
                            </td>

                            <td><input type="text" name="email[]" placeholder="Enter email address"
                                    class="form-control email_list" /></td>

                            <td><input type="text" name="phone[]" placeholder="Enter phone number"
                                    class="form-control phone_list" /></td>

                            <td><input type="file" name="cv[]" placeholder="Upload CV" class="form-control cv_list"
                                    multiple />
                            </td>

                            <td><input type="text" name="interview_time[]" placeholder="Enter interview time"
                                    class="form-control timepicker" />
                            </td>
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add another
                                    candidate</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            {{-- <input type="button" name="submit" id="submit" class="btn btn-primary" value="Add Candidates" /> --}}
            <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Add
                Candidates</button>
        </div>
        {!! Form::close() !!}
    </div>
    <!-- /.modal-content -->
</div>
</div>