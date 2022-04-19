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
                        <img src="{{ Gravatar::get($user->email, ['size' => 200]) }}">
                    </div>
                    <a href="{{ $user->facebook_link }}" class="sosmed-icon"><img src="/frontend/assets/images/sosmed/fb.png"></a>
                    <a href="{{ $user->youtube_link }}" class="sosmed-icon"><img src="/frontend/assets/images/sosmed/yt.png"></a>
                    <a href="{{ $user->twitter_link }}" class="sosmed-icon"><img src="/frontend/assets/images/sosmed/twitter.png"></a>
                    <a href="{{ $user->instragram_link }}" class="sosmed-icon"><img src="/frontend/assets/images/sosmed/ig.png"></a>
                    @can('update', $user)
                    <a href="{{ route('user.transaction.history', $user->user_id) }}" class="btn btn-primary btn-full tr">Transaksi</a>
                    <a href="{{ route('profile.edit', $user->user_id) }}" class="btn btn-warning btn-full tr">Ubah Info Anda</a>
                    @endcan
                </div>
                <div class="col-md-5">
                    <h3>{{ $user->getFullName() }}</h3>
                    <p>
                        {{ $user->shortbio }}
                    </p>
                </div>
                <div class="col-md-4">
                    <h3>Info</h3>
                    <table>
                        <tr>
                            <th><i class="fa fa-envelope"></i> Email</th>
                            <td>{{ $user->email }}</td>
                        </tr>
                        @if ($user->phone_number)
                        <tr>
                            <th><i class="fa fa-phone"></i> No Telp</th>
                            <td>{{ $user->phone_numbergi }}</td>
                        </tr>
                        @endif
                        <tr>
                            <th><i class="fa fa-check"></i> Mulai aktif</th>
                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-sign-in"></i> Terakhir login</th>
                            <td>{{ \Carbon\Carbon::parse($user->last_login)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th><i class="fa fa-newspaper-o"></i> Membantu</th>
                            <td>{{ count($user->transactions) }} Program</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- campaign donasi -->
<section id="donasi" class="detail member">
    <div class="container">
        @if (count($user->transactions))
        <div class="title">
            <h1>Program yang di bantu</h1>
        </div>
        <div class="con-donasi">
            <div class="row">

                    @foreach($user->transactions as $transaction)
                        <div class="col-md-4">
                            <div class="donasi-card">
                                <div class="con-img">
                                    <img class="img-res" src="{{ $transaction->program->image }}">
                                </div>
                                @if($transaction->program->is_targeted)
                                <div class="percent" data-percent='{{ $transaction->program->fund_accumulation_percentage }}'>
                                    <div class="bar blue"><span></span></div>
                                </div>
                                <p class="title-card">{{ $transaction->program->title }}</p>
                                @else
                                <p class="title-card mt-3">{{ $transaction->program->title }}</p>
                                @endif
                                <div class="col-md-12">
                                    <div class="half">
                                        <a class="btn btn-full btn-primary" href="{{ route('programs.kontribusi', $transaction->program->program_id) }}">Bantu</a>
                                    </div>
                                    <div class="half">
                                        <a class="btn btn-full btn-success" href="{{ route('programs.detail', $transaction->program->program_id) }}">Detail</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-12 footer">
                                    <div class="row">
                                        <div class="col-6 footer-text align-left">
                                            <small>Tercapai</small>
                                            <span>{{ $transaction->program->akumulasi }}</span>
                                        </div>
                                        <div class="col-6 footer-text align-right">
                                            <small>Sisa hari</small>
                                            @if(!$transaction->program->is_continuous)
                                            <span>{{ $transaction->program->day_diff }} hari lagi</span>
                                            @else
                                            <span style="font-size: 16pt">&infin;</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

            </div>
        </div>
        @else
            <div class="title">
                <h1>Belum ada program yang dibantu</h1>
                @if(auth()->user()->user_id == $user->id)
                <a href="{{ route('programs.donasi') }}" class="btn btn-primary mt-5">Mari Bantu</a>
                @endif
            </div>
        @endif
    </div>
</section>
@endsection