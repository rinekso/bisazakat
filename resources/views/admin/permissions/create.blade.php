@extends('admin.default')

@section('page-header')
  Permission <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
    {!! Form::open([
        'action' => ['Admin\PermissionController@store'],
        'files' => true
      ])
    !!}

    @include('admin.permissions.form')

    <button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
    
  {!! Form::close() !!}
  

@stop

