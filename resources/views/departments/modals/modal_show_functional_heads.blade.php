<div class="modal fade in" id="modal_show_functional_heads_{{ $item->department_id }}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!! Form::open(['url' => action('DepartmentController@store'), 'method' => 'post'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Departmental Functional Heads</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                  {{-- <table id="example1" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Candidate Name</th>
                                <th>Candidate Email</th>
                                <th>Phone Number</th>
                                <th>Decision</th>
                                <th>Decision By</th>
                                <th>Submitted At</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table> --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                {{-- <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Create New Department
                </button> --}}
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>