<div class="modal fade" id="modal_edit_department_{{ $item->department_id }}">
    <div class="modal-dialog">
        <div class="modal-content">
            {!!
            Form::open(['action'=>['DepartmentController@updateDepartment'],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
            !!}

            <input type="hidden" name="department_id" value="{{ $item->department_id }}">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Department</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('Department Name *') !!}
                            <div class="form-group">
                                {{Form::text('department_name', $item->department_name, ['class' => 'form-control',
                            'required' ])}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{Form::label('Country ')}}
                        <div class="form-group">
                            <select class="form-control select2" name="country_id" id="countries" required
                                style="width: 100%;" tabindex="-1" aria-hidden="true">
                                <option value="{{ $item->countryId }}">{{ $item->country_name }}</option>
                                @foreach($countries as $item)
                                <option value='{{ $item->id }}'>{{ $item->country_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat" data-dismiss="modal"><i class="fa fa-times"></i>
                    Cancel</button>
                <button type="submit" class="btn btn-primary btn-flat"><i class="fa fa-check"></i> Update
                    Department</button>
            </div>
            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>