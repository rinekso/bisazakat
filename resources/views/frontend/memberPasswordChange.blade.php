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
                        <a href="{{ url($user->facebook_link) }}" class="sosmed-icon"><img
                                    src="/frontend/assets/images/sosmed/fb.png"></a>
                        <a href="{{ $user->youtube_link }}" class="sosmed-icon"><img
                                    src="/frontend/assets/images/sosmed/yt.png"></a>
                        <a href="{{ $user->twitter_link }}" class="sosmed-icon"><img
                                    src="/frontend/assets/images/sosmed/twitter.png"></a>
                        <a href="{{ $user->instragram_link }}" class="sosmed-icon"><img
                                    src="/frontend/assets/images/sosmed/ig.png"></a>
                        <a href="/transaksi/history" class="btn btn-primary btn-full tr">Transaksi</a>
                        <a href="{{ route('profile.show', $user->user_id) }}" class="btn btn-primary btn-full tr">Info Anda</a>
                        <a href="{{ route('profile.edit', $user->user_id) }}" class="btn btn-warning btn-full tr">Ubah Info Anda</a>
                    </div>
                    <div class="col-md-9">
                        @if (Session::has('warning'))
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                {{Session::get('warning')}}
                            </div>
                        @endif

                        @if (Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                {{Session::get('success')}}
                            </div>
                        @endif

                        <form action="{{ route('profile.update.password', $user->user_id) }}" method="POST">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label col-form-label-bg">Password Lama</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="password" class="form-control" name="old_password"
                                           placeholder="Password Lama">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="form-text text-danger col-sm-12">
                                        <small>{{ $errors->first('old_password') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label col-form-label-bg">Password Baru</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="password" class="form-control" name="password"
                                           placeholder="Password Baru">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="form-text text-danger col-sm-12">
                                        <small>{{ $errors->first('password') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-sm-12 col-form-label col-form-label-bg">Konfirmasi Password
                                    Baru</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="Konfirmasi Password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="form-text text-danger col-sm-12">
                                        <small>{{ $errors->first('password_confirmation') }}</small>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <input type="hidden" name="page" value="user.password">
                                    <button class="btn btn-success btn-full">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
