<div class="modal fade in" id="modal_add_department" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" style="width:70%">
        <div class="modal-content">
            {!! Form::open(['url' => action('DepartmentController@store'), 'method' => 'post'])
            !!}
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add New Department</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
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
                            {!! Form::label('Department Name *') !!}
                            <div class="form-group">
                                {{Form::text('department_name', null, ['class' => 'form-control', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('Functional Head Name *') !!}
                            <div class="form-group">
                                {{Form::text('name', null, ['class' => 'form-control', 'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('Functional Head Email*') !!}
                            <div class="form-group">
                                {{Form::email('email', null, ['class' => 'form-control', 'required' ])}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Create New Department
                </button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>