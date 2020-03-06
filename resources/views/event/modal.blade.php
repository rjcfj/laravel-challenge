<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Import</h4>
            </div>
            <div class="modal-body">
                {!! Form::open(array('route' => 'event.import', 'method'=>'POST', 'enctype'=> 'multipart/form-data', 'class' => 'form-horizontal')) !!}
                    <div class="form-group">
                        {!! Form::label('file', 'CSV file', ['class' => 'col-md-2 control-label']) !!}
                        <div class="col-md-8 {{ $errors->has('title') ? 'has-error' : '' }}">
                            {!! Form::file('file', old('file'), ['class' => 'form-control', 'required']) !!}
                            @if ($errors->has('file'))
                            <div class="text-danger">
                                {{ $errors->first('file') }}
                            </div>
                            @endif
                        </div>
                        <div class="col-md-2">
                            {!! Form::submit('Import', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>