@extends('admin.default')

@section('page-header')
  Role <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
    {!! Form::open([
        'action' => ['Admin\RoleController@store'],
        'files' => true
      ])
    !!}

    @include('admin.roles.form')

    @if (count($permissions) != 0)
        <button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>
    @endif
  {!! Form::close() !!}
  

@stop

