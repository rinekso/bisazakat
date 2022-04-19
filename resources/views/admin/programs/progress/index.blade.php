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

                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection