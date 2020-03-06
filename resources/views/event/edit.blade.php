@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Event</div>
                <div class="panel-body">
                {!! Form::model($event, ['route' => ['event.update', $event->id], 'method' => 'put', 'class' => 'form-horizontal']) !!}
                        @include('event.from')
                    <br>
                    <div class="form-group">
                        <div class="col-md-1 col-md-offset-9">
                            <a href="{{ route('event.index') }}" class="btn btn-default">Cancel</a>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary">
                                Save
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection