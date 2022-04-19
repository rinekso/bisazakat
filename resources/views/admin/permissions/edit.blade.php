@extends('admin.default')

@section('page-header')
  Permission <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
    {!! Form::model($permission, [
        'action' => ['Admin\PermissionController@update', $permission->id],
        'method' => 'put', 
        'files' => true
      ])
    !!}

    <div class="row mB-40">
        <div class="col-sm-8">
            <div class="bgc-white p-20 bd">
                {!! Form::myInput('text', 'name', 'Nama Permission') !!}
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ trans('app.edit_button') }}</button>
    
  {!! Form::close() !!}
  

@stop

