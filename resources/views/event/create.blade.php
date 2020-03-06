@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Event</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'event.store', 'method' => 'post', 'role' => 'form', 'class' => 'form-horizontal']) !!}
                        @include('event.from')
                    <br>
                    <div class="form-group">
                        <div class="col-md-1 col-md-offset-9">
                            <a href="{{ route('event.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                        <div class="col-md-1">
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection