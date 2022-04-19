<?php
$nav = "active";
$menu = 3; //member
$title = "Member";
?>
@extends('frontend.layout')
@section('content')
    <section id="member" class="detail bg-res">
        <div class="cover">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="con-img circle">
                            <img src={{ Gravatar::get($user->email, ['size'=>200]) }}>
                        </div>
                        <h3 class="align-center">Nama Orang</h3>
                        <a href="{{ route('profile.show', $user->user_id) }}" class="btn btn-primary btn-full">Info User</a>
                    </div>
                    <div class="col-md-9">
                        <h2>Donasi</h2>
                        <table id="datatable-responsive" class="table table-hover dt-responsive nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama program</th>
                                <th>Nominal</th>
                                <th>Bukti</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->transactions as $transaction)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $transaction->program->title}}</td>
                                    <td>Rp{{ number_format($transaction->amount, 2, '.', ',') }}</td>

                                    @if($transaction->proof_of_payment_id)
                                        <td><a href="{{ asset('storage/'.$transaction->proofOfTransfer->image) }}">Lihat Bukti</a></td>
                                    @else
                                        <td>
                                            <form action="{{ route('user.transaction.proof.upload', [auth()->user()->user_id, $transaction->transaction_uuid]) }}"
                                                  method="POST"
                                                  enctype="multipart/form-data">
                                                {{ csrf_field() }}
                                                <input type="file" class="upload" name="bukti" required>
                                                <button type="sumbit" class="btn btn-success">Upload</button>
                                            </form>
                                        </td>
                                    @endif
                                    @switch($transaction->status)
                                        @case(0)
                                        <td><span class="text-info">Belum Terkonfirmasi</span></td>
                                        @break
                                        @case(1)
                                        <td><span class="text-info">Terkonfirmasi</span></td>
                                        @break
                                        @case(2)
                                        <td><span class="text-info">Expired</span></td>
                                        @break
                                    @endswitch
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('jsCustom')
    <!-- Datatables -->
    <script src="/frontend/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="/frontend/assets/vendor/datatables.net-scroller/js/datatables.scroller.min.js"></script>
    <script type="text/javascript" src="/frontend/assets/js/app.js"></script>

    <script type="text/javascript">
        $(function(){
            $('#datatable-responsive').DataTable();
        })
    </script>
@endsection