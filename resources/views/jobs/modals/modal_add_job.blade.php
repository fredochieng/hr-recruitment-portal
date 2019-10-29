<div class="modal fade in" id="modal_add_job" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!! Form::open(['url' => action('JobPostingsController@store'), 'method' => 'post'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Job Posting</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Opening Name *') !!}
                            <div class="form-group">
                                {{Form::text('opening_name', null, ['class' => 'form-control', 'id' => 'opening_name', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Job Type ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="posting_type_id" id="posting_type_id" required
                                style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Select job type</option>
                                @foreach($job_types as $item)
                                <option value='{{ $item->id }}'>{{ $item->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        {{Form::label('Country ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="country_id" id="countries" required
                                style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="">Select country</option>
                                @foreach($countries as $item)
                                <option value='{{ $item->id }}'>{{ $item->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control select2" name="department_id" id="departments"
                                style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="0" disabled="true" selected="true">Select country first</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('Number of candidates needed *') !!}
                            <div class="form-group">
                                {{Form::number('no_of_candidates', null, ['class' => 'form-control', 'min'=>'1', 'id' => 'no_of_candidates', 'required' ])}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Create New Job
                    Posting</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>