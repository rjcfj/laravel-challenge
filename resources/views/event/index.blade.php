@extends('layouts.app')
@section('content')

<div class="container">
        <div class="row">
            <div class="form-group">
                <div class="col-md-5">
                    <a href="{{ route('event.index',['get' => 'all']) }}" class="btn btn-default">All events</a>
                    <a href="{{ route('event.index',['get' => 'next']) }}" class="btn btn-default">Next events</a>
                    <a href="{{ route('event.index',['get' => 'today']) }}" class="btn btn-default">Today's events</a>
                </div>
                <div class="col-md-1 col-md-offset-4">
                    <a href="{{ route('event.export', ['id' => 'null'])}}" class="btn btn-success">Export all</a>
                </div>
                <div class="col-md-1">
                <button class="btn btn-success" data-toggle="modal" data-target=".bs-example-modal-lg">Import</button>
                </div>
                <div class="col-md-1">
                    <a href="{{ route('event.create') }}" class="btn btn-primary">New event</a>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-12">
            @include('flash::message')
            <table class="table">
                <thead>
                    <tr>
                        <td>Title</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Description</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($events as $event)
                    <tr>
                        <td><strong class="text-info">{{ $event->title }}</strong></td>
                        <td>
                            {{\Carbon\Carbon::parse($event->start)->format('d/m/Y')}} -
                            {{\Carbon\Carbon::parse($event->start)->format('H:i')}}
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($event->end)->format('d/m/Y')}} -
                            {{\Carbon\Carbon::parse($event->end)->format('H:i')}}
                        </td>
                        <td>{{$event->description}}</td>
                        <td><a href="{{ route('event.edit', $event->id) }}" class="btn btn-primary" style="float: left;margin-right: 3px;">Edit</a>
                        {!! Form::open(['route' => ['event.destroy', $event->id], 'method' => 'post', 'style' => 'float: left;margin-right: 3px;']) !!}    
                        <div class="hidden">
                        @method('DELETE')
                        {!! method_field('delete') !!}
                        </div>
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                        <a href="{{ route('event.export', $event->id) }}" class="btn btn-success">Export</a>
                        <a href="{{ route('event.invite', $event->id) }}" class="btn btn-default">Invite</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $events->appends($filter)->render() }}
        <div>
    </div>
@include('event.modal')
@endsection