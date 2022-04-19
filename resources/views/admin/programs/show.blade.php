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
                    <a class="nav-link" href="{{ route('admin.progress.index', $program->program_id) }}">Progress Report</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h6 class="lh-1">Nama Program</h6>
                <h4>{{ $program->title }}</h4>
                <hr>

                <h6 class="lh-1">Kategori</h6>
                <h4>{{ $program->category->name }}</h4>
                <hr>

                <h6 class="lh-1" for="">Total Dana Terkumpul</h6>
                <h4>{{ $program->akumulasi }}</h4>
                <hr>

                <h6 class="lh-1" for="">Tanggal Berakhir</h6>
                <h4>{{ $program->closed_at }}</h4>
                <hr>

                <div class="mB-20">
                    <a href="{{ route(ADMIN . '.programs.index') }}" class="btn btn-default">
                        Back
                    </a>
                    <a href="{{ route(ADMIN . '.programs.edit', $program->program_id) }}" class="btn btn-info">
                        Edit
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Nomor Transaksi</th>
                                <th>Jumlah Dana</th>
                                <th>Tanggal Donasi</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>

                            <tbody>
                                @foreach($transactions as $transaction)
                                  <tr>
                                      <td>
                                          <a href="{{ route('admin.transactions.show', $transaction->transaction_uuid) }}">{{ $transaction->transaction_uuid }}</a>
                                      </td>
                                      <td>
                                          {{ $transaction->rupiah}}
                                      </td>
                                      <td>
                                          {{ $transaction->created_at }}
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
        </div>
    </div>
@endsection