<div class="modal fade in" id="modal_average_ratings_{{ $interviews->interview_id }}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Average Ratings</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-hover" style="font-size:12px">
                        <thead>
                            <tr>
                                <th>Candidate Name</th>
                                <th>Candidate Email</th>
                                <th>Phone Number</th>
                                <th>Interview Start Time</th>
                                <th>Interview End Time</th>
                                <th>Decision</th>
                                <th>Average Marks</th>
                                @if((auth()->user()->can('interview.offer_letter')))
                                <th>Action (Offer Letter/ Second Interview)</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($average_ratings as $count => $item)
                            <tr>
                                <td>{{ $item->candidate_name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->phone }}</td>
                                <td>{{ $item->session_start_time }}</td>
                                <td>{{ $item->session_end_time }}</td>
                                <td>{{ $item->decision }}</td>
                                <td><strong>{{ round($item->average_marks) }}/ 80 Marks</strong></td>
                                <td>
                                    @if((auth()->user()->can('interview.offer_letter')))
                                    @if ($item->interview_decision_id == 1 || $item->interview_decision_id == 2)
                                    <a href="" data-backdrop="static" disabled data-keyboard="false" data-toggle="modal"
                                        data-target="#modal_offer_letterdddd_{{$item->cand_id}}"
                                        class="btn btn-xs btn-primary"><i class="fas fa-fw fa-check"></i> Offer
                                        Letter</a>
                                    @elseif($item->interview_decision_id != 1)
                                    <a href="" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                        data-target="#modal_offer_letter_{{$item->cand_id}}"
                                        class="btn btn-xs btn-primary"><i class="fas fa-fw fa-check"></i> Offer
                                        Letter</a>
                                    @elseif($item->interview_decision_id == '')
                                    <a href="" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                        data-target="#modal_offer_letter_{{$item->cand_id}}"
                                        class="btn btn-xs btn-primary"><i class="fas fa-fw fa-check"></i> Offer
                                        Letter</a>
                                    @endif
                                    @endif

                                    @if((auth()->user()->can('interview.second_interview')))
                                    @if ($item->interview_decision_id == 2 || $item->interview_decision_id == 1)
                                    <a href="" data-backdrop="static" disabled data-keyboard="false" data-toggle="modal"
                                        data-target="#modal_second_interviewdddd_{{$item->cand_id}}"
                                        class="btn btn-xs btn-warning"><i class="fas fa-fw fa-bolt"></i> Second
                                        Interview</a>
                                    @elseif($item->interview_decision_id != 2)
                                    <a href="" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                        data-target="#modal_second_interview_{{$item->cand_id}}"
                                        class="btn btn-xs btn-warning"><i class="fas fa-fw fa-bolt"></i> Second
                                        Interview</a>
                                    @elseif($item->interview_decision_id == '')
                                    <a href="" data-backdrop="static" data-keyboard="false" data-toggle="modal"
                                        data-target="#modal_second_interview_{{$item->cand_id}}"
                                        class="btn btn-xs btn-warning"><i class="fas fa-fw fa-bolt"></i> Second
                                        Interview</a>
                                    @endif
                                    @endif
                                </td>
                            </tr>
                            @include('interviews.modals.modal_offer_letter')
                            @include('interviews.modals.modal_second_interview')
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
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