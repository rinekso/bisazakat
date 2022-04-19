@extends('admin.default')

@section('page-header')
  User <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
    {!! Form::model($item, [
        'action' => ['Admin\UserController@update', $item->user_id],
        'method' => 'PUT',
        'files' => false
      ])
    !!}

    @include('admin.users.form')

    <button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
    
  {!! Form::close() !!}
  

@stop

