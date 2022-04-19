@extends('admin.default')

@section('page-header')
    Detail Transaksi
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <div class="row">
                    <div class="col">
                        <h3>Transaksi</h3>
                        <small class="lh-1">ID Transaksi</small>
                        <h6>{{ $transaction->transaction_uuid }}</h6>
                        <small class="lh-1">Status Transaksi</small>
                        <br>
                        @if ($transaction->is_expired && $transaction->status != 1 )
                            <p class="badge badge-danger">Expired</p>
                        @else
                            @switch($transaction->status)
                                @case(0)
                                <p class="badge badge-info">Pending</p>
                                @break;
                                @case(1)
                                <p class="badge badge-success">Success</p>
                                @break;
                                @case(2)
                                <p class="badge badge-danger">Expired</p>
                                @break;
                            @endswitch
                        @endif
                    </div>
                    <div class="col-md-3 pull-right">
                        <small class="lh-1">Nomor Unik</small>
                        <h2 class="">{{ $transaction->last_digit_unique_code }}</h2>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">
                        <small class="lh-1">Nama Donatur</small>
                        <h5>{{ $transaction->user->getFullName() }}</h5>
                    </div>
                    <div class="col-6">
                        <small class="lh-1">Nominal Yang Harus Di Bayar</small>
                        <h5>{{ $transaction->getRupiahFormat() }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <small class="lh-1">Email Donatur</small>
                        <h5>{{ $transaction->user->email }}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <small class="lh-1">Jenis Pembayaran</small>
                        <br>
                        @switch($payment->payment_type)
                            {{--Bank Transfer--}}
                            @case(1)
                            <h5>Bank Transfer - {{ $transaction->program->category->coa->bank_account }}</h5>
                            @break
                            {{--Todo: BCA API - To be implemented--}}
                            @case(2)

                            @break
                        @endswitch
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <small class="lh-1">Tanggal Jatuh Tempo</small>
                        <h5>{{ $transaction->jatuh_tempo }}</h5>
                    </div>
                </div>
            </div>

            @if($payment->status && $transaction->status == 1)
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <div class="row">
                        <div class="col">
                            <h3>Pembayaran</h3>
                            <small class="lh-1">ID Pembayaran</small>
                            <h6>{{ $payment->payment_uuid }}</h6>
                            <small class="lh-1">Status Pembayaran</small>
                            <br>
                            @switch($payment->status)
                                @case(0)
                                <p class="badge badge-info">Pending</p>
                                @break;
                                @case(1)
                                <p class="badge badge-success">Success</p>
                                @break;

                            @endswitch
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <small class="lh-1">Nama Donatur</small>
                            <h5>{{ $transaction->user->getFullName() }}</h5>
                        </div>
                        <div class="col-6">
                            <small class="lh-1">Nominal Yang Di Bayar</small>
                            <h5>{{ $transaction->getRupiahFormat() }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <small class="lh-1">Email Donatur</small>
                            <h5>{{ $transaction->user->email }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <small class="lh-1">Jenis Pembayaran</small>
                            <br>
                            @switch($payment->payment_type)
                                {{--Bank Transfer--}}
                                @case(1)
                                <h5>Bank Transfer - {{ $transaction->program->category->coa->bank_account }}</h5>
                                @break
                                {{--Todo: BCA API - To be implemented--}}
                                @case(2)

                                @break
                            @endswitch
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h6 class="lh-1">Konfirmasi Manual</h6>
                <hr>
                @if($transaction->proof_of_payment_id)
                    <div class="form-group">
                        <label for="">Bukti Transfer</label> <br>
                        <img class="img-fluid mb-2" id="bukti-image"
                             src="{{ asset('storage/'.$transaction->proofOfTransfer->image) }}">
                    </div>
                @else

                    <form action="{{ route('admin.transaction.proof.upload', $transaction->transaction_uuid) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            {!! Form::myInput('file', 'bukti', 'Upload Bukti Transaksi') !!}

                        </div>
                        <div class="form-group">
                            <button type="sumbit" class="btn btn-success">Upload</button>
                        </div>
                    </form>

                @endif
                <hr>

                    <form action="{{ route('admin.transaction.set_confirmation', $transaction->transaction_uuid) }}"
                          method="POST"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @if ($transaction->status != 1)

                            {!! Form::myInput('number', 'amount', 'Nominal Transfer', [], $transaction->amount) !!}

                            <div class="form-group">
                                <select name="confirmation" id="" class="form-control">
                                    <option value=1>Konfirmasi</option>
                                    <option value=0>Batalkan Konfirmasi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="sumbit" class="btn btn-success">Submit</button>
                            </div>
                        @else
                            <div class="form-group">
                                <select name="confirmation" id="" class="form-control">
                                    <option value=0>Batalkan Konfirmasi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="sumbit" class="btn btn-danger">Submit</button>
                            </div>
                        @endif

                    </form>

            </div>
        </div>
    </div>



@endsection

@section('additional-script')
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.eleveateZoom.js') }}"></script>
    <script>
        $('#bukti-image').elevateZoom({zoomWindowPosition: 10});


    </script>
@endsection