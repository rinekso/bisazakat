@extends('admin.default')

@section('page-header')
    Roles <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

<div class="mB-20">
    <a href="{{ route(ADMIN . '.roles.create') }}" class="btn btn-info">
        {{ trans('app.add_button') }}
    </a>
</div>

<div class="row">
    <div class="col-md-12">
      <div class="bgc-white bd bdrs-3 p-20 mB-20">
        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
            
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
             
                <tbody>
                    @foreach ($roles as $item)
                        <tr>
                            <td><a href="{{ route(ADMIN . '.roles.edit', $item->id) }}">{{ $item->name }}</a></td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route(ADMIN . '.roles.edit', $item->id) }}" title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span class="ti-pencil"></span></a></li>
                                    <li class="list-inline-item">
                                        {!! Form::open([
                                            'class'=>'delete',
                                            'url'  => route(ADMIN . '.roles.destroy', $item->id),
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