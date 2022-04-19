@extends('admin.default')

@section('page-header')
    Detail Data Program
@endsection

@section('content')
    <div class="row mb-5">
        <div class="col-md-12">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.progress.index', $zakat->program_id) }}">Progress Report</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h6 class="lh-1">Nama Program</h6>
                <h4>{{ $zakat->title }}</h4>
                <hr>

                <h6 class="lh-1">Kategori</h6>
                <h4>{{ $zakat->category->name }}</h4>
                <hr>

                <h6 class="lh-1" for="">Total Dana Terkumpul</h6>
                <h4>{{ $zakat->akumulasi }}</h4>
                <hr>

                <h6 class="lh-1" for="">Tanggal Berakhir</h6>
                <h4>{{ $zakat->closed_at }}</h4>
                <hr>

                <div class="mB-20">
                    <a href="{{ route(ADMIN . '.zakat.index') }}" class="btn btn-default">
                        Back
                    </a>
                    <a href="{{ route(ADMIN . '.zakat.edit', $zakat->program_id) }}" class="btn btn-info">
                        Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="bgc-white bd bdrs-1 mB-20">
                <div class="layers">
                    <div class="layer w-100">
                        <div class="bgc-light-blue-500 c-white p-20">
                            <div class="peers ai-c jc-sb gap-40">
                                <div class="peer peer-greed"><h5>List Donatur</h5>
                                    <div class="row">

                                    </div>
                                <div class="peer">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="layer w-100 p-20">
                        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">

                            <thead>
                            <tr>
                                <th>Nomor Transaksi</th>
                                <th>Jumlah Dana</th>
                                <th>Tanggal Donasi</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Nomor Transaksi</th>
                                <th>Jumlah Dana</th>
                                <th>Tanggal Donasi</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>

                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection