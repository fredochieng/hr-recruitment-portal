<div class="modal fade in" id="modal_add_rating_senior_{{$candidates->candidate_id}}" data-backdrop="static"
    data-keyboard="false">
    <div class="modal-dialog" style="width:90%">
        <div class="modal-content">
            {!! Form::open(['url' => action('CandidateController@addRatings'), 'method' => 'post'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Rate Candidate - <b>{{ $candidates->name }}</b></h4>
            </div>
            <input type="hidden" name="candidate_id" value="{{ $candidates->candidate_id }}">
            <input type="hidden" name="job_type" value="1">
            <input type="hidden" name="full_marks" value="50">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Education Background *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'senior_rating_marks1', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Employment Experience *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'senior_rating_marks2', 'required', 'min'=> '1', 'max'=> '10', 'placeholder'=>'Rate between 1 & 10 (1 = lowest, 10= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Technical Skills/Job Knowledge *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'senior_rating_marks3', 'required', 'min'=> '1', 'max'=> '15', 'placeholder'=>'Rate between 1 & 15 (1 = lowest, 15= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Leadership Skills *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'senior_rating_marks4', 'required', 'min'=> '1', 'max'=> '10', 'placeholder'=>'Rate between 1 & 10 (1 = lowest, 10= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Interpersonal Skills *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'senior_rating_marks5', 'required', 'min'=> '1', 'max'=> '10', 'placeholder'=>'Rate between 1 & 10 (1 = lowest, 10= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('Total Marks') !!}
                            <div class="form-group">
                                {{Form::number('total_marks', null, ['class' => 'form-control', 'id'=>'senior_total_marks'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::label('Overall Rating') !!} </br>
                            <label>
                                <input type="radio" name="overall_rating_id" value="1" class="flat-red">
                                Poor
                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="overall_rating_id" value="2" class="flat-red">
                                Satisfactory
                            </label>&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="overall_rating_id" value="3" class="flat-red">
                                Good
                            </label>&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="overall_rating_id" value="4" class="flat-red">
                                Vey Good
                            </label>&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="overall_rating_id" value="5" class="flat-red">
                                Excellent
                            </label>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            {!! Form::label('Recommendations') !!} </br>
                            <label>
                                <input type="radio" name="recommendation_id" value="1" class="flat-red">
                                Appointment
                            </label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="recommendation_id" value="2" class="flat-red">
                                Fall Back Candidate
                            </label>&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="recommendation_id" value="3" class="flat-red">
                                Final Interview
                            </label>&nbsp;&nbsp;
                            <label>
                                <input type="radio" name="recommendation_id" value="4" class="flat-red">
                                Not Suitable
                            </label>&nbsp;&nbsp;
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit Ratings</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>