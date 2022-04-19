@extends('admin.default')

@section('page-header')
    Transaksi
    <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')
    <div class="row mT-20">
        <div class="col-md-12">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">

                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Program</th>
                        <th>Donatur</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Program</th>
                        <th>Donatur</th>
                        <th>Jumlah</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <a href="{{ route('admin.transactions.show', $transaction->transaction_uuid) }}">{{ $transaction->program->title }}</a>
                            </td>
                            <td>
                                {{ $transaction->full_name }}
                            </td>
                            <td>
                                {{ $transaction->getRupiahFormat() }}
                            </td>
                            <td>
                                @if ($transaction->is_expired || $transaction->status == 2)
                                    <div class="badge badge-danger col">Expired</div>
                                @else
                                    @switch($transaction->status)
                                        @case(0)
                                        <div class="badge badge-info col">Pending</div>
                                        @break;
                                        @case(1)
                                        <div class="badge badge-success col">Success</div>
                                        @break;
                                    @endswitch
                                @endif
                            </td>
                            <td>
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <a href="{{ route(ADMIN . '.transactions.show', $transaction->transaction_uuid) }}"
                                           title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span
                                                    class="ti-pencil"></span></a></li>

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
