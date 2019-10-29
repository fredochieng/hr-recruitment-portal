<div class="modal fade in" id="modal_selected_candidates_{{ $interviews->interview_id }}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Selected Candidates</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-hover" style="font-size:11px">
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
                            @foreach ($selected_candidates as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->decision }}</td>
                                <td>{{ $item->decision_by_name }}</td>
                                <td>{{ $item->created_by }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="table-responsive">
                        <table id="example2" class="table table-hover" style="font-size:11px">
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
                                @foreach ($selected_candidates as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->decision }}</td>
                                    <td>{{ $item->decision_by_name }}</td>
                                    <td>{{ $item->created_by }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </div>
</div>