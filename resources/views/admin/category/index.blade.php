@extends('admin.default')

@section('page-header')
    Kategori <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

<div class="mB-20">
    <a href="{{ route(ADMIN . '.categories.create') }}" class="btn btn-info">
        {{ trans('app.add_button') }}
    </a>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            
                <thead>
                    <tr>
                        <th>Kategori</th>
                        <th>CoA Number</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>Kategori</th>
                        <th>CoA Number</th>
                        <th>Deskripsi</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
             
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td><a href="{{ route(ADMIN . '.categories.edit', $item->category_id) }}">{{ $item->name }}</a></td>
                            <td>{{ $item->coa->coa_number }}</td>
                            <td>{{ $item->description }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route(ADMIN . '.categories.edit', $item->category_id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a>
                                    </li>
                                    <li class="list-inline-item">
                                        {!! Form::open([
                                            'class'=>'delete',
                                            'url'  => route(ADMIN . '.categories.destroy', $item->category_id),
                                            'method' => 'DELETE',
                                            ]) 
                                        !!}

                                            <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i class="ti-trash"></i></button>
                                            
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            
        </table>
      </div>
    </div>
  </div>

@endsection