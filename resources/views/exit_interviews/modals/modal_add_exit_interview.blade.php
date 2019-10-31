<div class="modal fade in" id="modal_add_exit_interview" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!! Form::open(['url' => action('ExitInterviewsController@store'), 'method' => 'post'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Exit Interview</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Employee Name *') !!}
                            <div class="form-group">
                                {{Form::text('employee_name', null, ['class' => 'form-control', 'id' => 'employee_name', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Employee Number *') !!}
                            <div class="form-group">
                                {{Form::text('employee_no', null, ['class' => 'form-control', 'id' => 'employee_no', 'required' ])}}
                            </div>
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
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control select2" name="department_id" id="departments"
                                style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="0" disabled="true" selected="true">Select country first</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Current Position *') !!}
                            <div class="form-group">
                                {{Form::text('current_position', null, ['class' => 'form-control', 'id' => 'current_position', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Start Date *') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{Form::text('start_date', null, ['class' => 'form-control date_selector', 'id' => 'start_date', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Exit Date *') !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                {{Form::text('exit_date', null, ['class' => 'form-control date_selector', 'id' => 'exit_date', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('Immediate Supervisor *') !!}
                            <div class="form-group">
                                {{Form::text('supervisor', null, ['class' => 'form-control', 'id' => 'supervisor', 'required' ])}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Create New Exit Interview
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>