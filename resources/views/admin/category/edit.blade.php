@extends('admin.default')

@section('page-header')
  Kategori <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')
    {!! Form::model($item, [
        'action' => ['Admin\CategoryController@update', $item],
        'method' => 'put', 
        'files' => false
      ])
    !!}

    @include('admin.category.form')

    <a href="{{ route('admin.coa.index')  }}" class="btn btn-primary">Batal</a>
    <button type="submit" class="btn btn-success">{{ trans('app.edit_button') }}</button>
    
  {!! Form::close() !!}
  

@stop

