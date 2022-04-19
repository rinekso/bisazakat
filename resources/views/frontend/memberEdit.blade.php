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
                        <a href="{{ url($user->facebook_link) }}" class="sosmed-icon"><img src="/frontend/assets/images/sosmed/fb.png"></a>
                        <a href="{{ $user->youtube_link }}" class="sosmed-icon"><img src="/frontend/assets/images/sosmed/yt.png"></a>
                        <a href="{{ $user->twitter_link }}" class="sosmed-icon"><img src="/frontend/assets/images/sosmed/twitter.png"></a>
                        <a href="{{ $user->instragram_link }}" class="sosmed-icon"><img src="/frontend/assets/images/sosmed/ig.png"></a>
                        <a href="/transaksi/history" class="btn btn-primary btn-full tr">Transaksi</a>
                        <a href="{{ route('profile.show', $user->user_id) }}" class="btn btn-primary btn-full tr">Info Anda</a>
                        <a href="{{ route('profile.edit.password', $user->user_id) }}" class="btn btn-warning btn-full tr">Ubah Password Anda</a>

                    </div>
                    <div class="col-md-9">
                        <form action="{{ route('profile.update', $user->user_id) }}" method="POST">
                            {{ method_field('PUT') }}
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">Nama Depan</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="text" class="form-control" name="first_name" placeholder="Nama depan anda" value="{{ $user->first_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">Nama Belakang</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="text" class="form-control" name="last_name" placeholder="Nama belakang anda" value="{{ $user->last_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">Email</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="text" class="form-control" name="email" placeholder="email" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">No Telepon</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="text" class="form-control" name="phone_number" placeholder="08XXXXXXX" value="{{ $user->phone_number }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">Biografi</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <textarea class="form-control" name="shortbio" placeholder="ceritakan sedikit tentang anda">{{ $user->shortbio }}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">Link Fb</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="text" class="form-control" name="facebook_link" value="{{ $user->facebook_link }}" placeholder="Link Fb">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">Link Youtube</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="text" class="form-control" name="youtube_link" value="{{ $user->youtube_link }}" placeholder="Link Youtube">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">Link Instagram</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="text" class="form-control" name="instagram_link" value="{{ $user->instagram_link }}" placeholder="Link Instagram">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-bg">Link Twitter</label>
                                <div class="input-group mb-2 col-sm-10">
                                    <input type="text" class="form-control" name="twitter_link" value="{{ $user->twitter_link }}" placeholder="Link Twitter">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    <input type="hidden" name="page" value="user.profile">
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
