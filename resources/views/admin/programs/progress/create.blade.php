@extends('admin.default')

@section('additional-css')

@stop
@section('page-header')
  Update Perkembangan <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
    {!! Form::open([
        'action' => ['Admin\ProgramProgressController@store', $program->program_id],
        'files' => true
      ])
    !!}

    @include('admin.programs.progress.form')

    <a href="{{ route('admin.programs.index')  }}" class="btn btn-primary">Batal</a>
    <button type="submit" class="btn btn-success">{{ trans('app.add_button') }}</button>

  {!! Form::close() !!}
  

@stop

@section('additional-script')

@stop