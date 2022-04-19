@extends('admin.default')

@section('page-header')
    Program <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

<div class="mB-20">
    <a href="{{ route(ADMIN . '.programs.create') }}" class="btn btn-info">
        {{ trans('app.add_button') }}
    </a>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">

                <thead>
                <tr>
                    <th>Nama Program</th>
                    <th>Kategori</th>
                    <th>Akumulasi Dana</th>
                    <th>Target Dana</th>
                    <th>Waktu Berakhir</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tfoot>
                <tr>
                    <th>Nama Program</th>
                    <th>Kategori</th>
                    <th>Akumulasi Dana</th>
                    <th>Target Dana</th>
                    <th>Waktu Berakhir</th>
                    <th>Action</th>
                </tr>
                </tfoot>

                <tbody>
                @foreach ($items as $item)
                    <tr>
                        <td><a href="{{ route('admin.programs.show', $item->program_id) }}">{{ $item->title }}</a></td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->akumulasi }}</td>
                        <td>{!! $item->description !!}</td>
                        <td>{{ $item->closed_at }}</td>
                        <td>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . '.programs.edit', $item->program_id) }}"
                                       title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span
                                                class="ti-pencil"></span></a>
                                </li>
                                <li class="list-inline-item">
                                    {!! Form::open([
                                        'class'=>'delete',
                                        'url'  => route(ADMIN . '.programs.destroy', $item->program_id),
                                        'method' => 'DELETE',
                                        ])
                                    !!}

                                    <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i
                                                class="ti-trash"></i></button>

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