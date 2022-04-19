@extends('admin.default')

@section('page-header')
  Admin <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
    {!! Form::open([
        'action' => ['Admin\EmployeeController@store'],
        'method' => 'post',
        'files' => true
      ])
    !!}

    @include('admin.users.form')

    <button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
    
  {!! Form::close() !!}
  

@stop

