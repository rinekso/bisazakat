@extends('admin.default')

@section('page-header')
  Program <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
    {!! Form::model($item, [
        'action' => ['Admin\ProgramController@update', $item],
        'method' => 'put', 
        'files' => true
      ])
    !!}

    @include('admin.programs.form')

    <a href="{{ route('admin.programs.index')  }}" class="btn btn-primary">Batal</a>
    <button type="submit" class="btn btn-success">{{ trans('app.edit_button') }}</button>
    
  {!! Form::close() !!}
  

@stop

