<div class="form-group">
    {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-9 {{ $errors->has('title') ? 'has-error' : '' }}">
    {!! Form::text('title', old('title'), ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('title'))
        <div class="text-danger">
            {{ $errors->first('title') }}
        </div>
        @endif
    </div>
</div>
<div class="form-group">
    {!! Form::label('start', 'Begins', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('start') ? 'has-error' : '' }}">
    {!! Form::input('datetime-local', 'start', old('start') ? \Carbon\Carbon::parse($event->start)->format('Y-m-d\TH:i') : '', ['class'=>'form-control']) !!}
        @if ($errors->has('start'))
        <div class="text-danger">
            {{ $errors->first('start') }}
        </div>
        @endif
    </div>
    {!! Form::label('end', 'Ends', ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('end') ? 'has-error' : '' }}">
        {!! Form::input('datetime-local', 'end', old('end') ? \Carbon\Carbon::parse($event->end)->format('Y-m-d\TH:i') : '', ['class'=>'form-control']) !!}
        @if ($errors->has('end'))   
        <div class="text-danger">
            {{ $errors->first('end') }}
        </div>
        @endif
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-9 {{ $errors->has('description') ? 'has-error' : '' }}">
    {!! Form::textarea('description', old('description'), ['class' => 'form-control', 'required']) !!}
        @if ($errors->has('description'))
        <div class="text-danger">
            {{ $errors->first('description') }}
        </div>
        @endif
    </div>
</div>