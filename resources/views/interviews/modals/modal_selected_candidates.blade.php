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
                    <table id="example4" class="table table-hover" style="font-size:11px">
                        <thead>
                            <tr>
                                <th>Candidate Name</th>
                                <th>Candidate Email</th>
                                <th>Phone Number</th>
                                <th>Decision</th>
                                <th>Decision By ( Functional Head)</th>
                                <th>Submitted At</th>
                                @if((auth()->user()->can('interview.final_offer_letter')))
                                <th>Action (Offer Letter/ Second Interview)</th>
                                @endif
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
                                <td>
                                    @if((auth()->user()->can('interview.final_offer_letter')))
                                    @if($hr_submission == 'N')
                                    <a href="" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                        data-target="#modal_final_offer_letter_{{$item->cand_id}}"
                                        class="btn btn-xs btn-primary"><i class="fas fa-fw fa-check"></i> Offer
                                        Letter</a>
                                    @else
                                    <a href="" data-backdrop="static" data-keyboard="false" data-toggle="modal" disabled
                                        data-target="#modal_final_offer_letterdddd_{{$item->cand_id}}"
                                        class="btn btn-xs btn-primary"><i class="fas fa-fw fa-check"></i> Offer
                                        Letter</a>

                                    @endif
                                    @endif
                                    @if((auth()->user()->can('interview.final_second_interview')))
                                    @if($hr_submission == 'N')
                                    <a href="" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                        data-target="#modal_final_second_interview_{{$item->cand_id}}"
                                        class="btn btn-xs btn-warning"><i class="fas fa-fw fa-bolt"></i> Second
                                        Interview</a>
                                    @else
                                    <a href="" data-backdrop="static" data-keyboard="false" data-toggle="modal" disabled
                                        data-target="#modal_final_second_interviewdddd_{{$item->cand_id}}"
                                        class="btn btn-xs btn-warning"><i class="fas fa-fw fa-bolt"></i> Second
                                        Interview</a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @include('interviews.modals.modal_final_offer_letter')
                            @include('interviews.modals.modal_final_second_interview')
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
                                    <th>Decision By (HR Director)</th>
                                    <th>Submitted At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hr_director_selected_candidates as $item)
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