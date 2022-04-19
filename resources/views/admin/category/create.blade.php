@extends('admin.default')

@section('page-header')
  Kategori <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
    {!! Form::open([
        'action' => ['Admin\CategoryController@store'],
        'files' => true
      ])
    !!}

    @include('admin.category.form')

    <a href="{{ route('admin.categories.index')  }}" class="btn btn-primary">Batal</a>
    <button type="submit" class="btn btn-success">{{ trans('app.add_button') }}</button>

  {!! Form::close() !!}
  

@stop

