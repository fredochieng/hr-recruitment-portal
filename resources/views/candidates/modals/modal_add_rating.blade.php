<div class="modal fade in" id="modal_add_rating_{{$candidates->candidate_id}}" data-backdrop="static"
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
            <input type="hidden" name="job_type" value="2">
            <input type="hidden" name="full_marks" value="80">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Dress Up / Presentation *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks1', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Composure *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks2', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Attitude *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks3', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Motivation *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks4', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Communication *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks5', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Assertiveness *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks6', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Verbal / Persuasiveness *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks7', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Education / Professional *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks8', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Relevant Experience *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks9', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Computer Proficiency *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks10', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Technical Skills *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks11', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Business Knowledge *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks12', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Clarity of Thought *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks13', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Job Knowledge *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks14', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Clear Understanding of Questions *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks15', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('Logic *') !!}
                            <div class="form-group">
                                {{Form::number('rating_marks[]', null, ['class' => 'form-control', 'id'=>'rating_marks16', 'required', 'min'=> '1', 'max'=> '5', 'placeholder'=>'Rate between 1 & 5 (1 = lowest, 5= highest)'])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {!! Form::label('Total Marks') !!}
                            <div class="form-group">
                                {{Form::number('total_marks', null, ['class' => 'form-control', 'id'=>'total_marks'])}}
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