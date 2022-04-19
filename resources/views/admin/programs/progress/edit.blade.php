@extends('admin.default')

@section('page-header')
  Kategori <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
    {!! Form::model($programProgress, [
        'action' => ['Admin\ProgramProgressController@update', $program, $programProgress],
        'method' => 'put', 
        'files' => false
      ])
    !!}

    @include('admin.programs.progress.form')

    <a href="{{ route('admin.programs.index')  }}" class="btn btn-primary">Batal</a>
    <button type="submit" class="btn btn-success">{{ trans('app.edit_button') }}</button>
    
  {!! Form::close() !!}
  

@stop

