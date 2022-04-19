<?php
$nav = "active";
$menu = 1; //program
$title = "Detail Program"
?>
@extends('frontend.layout')

@section('og.meta')
    <meta property="og:url"                content={{ url()->current() }} />
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="{{ $program->title }}" />
    <meta property="og:description"        content="{{ strip_tags($program->description) }}" />
    <meta property="og:image"              content="{{ asset('storage/'.$program->image) }}" />
    <meta property="fb:app_id"              content="171785850192034" />
@endsection


@section('title')
    Detail
@endsection
@section('content')
    <section id="utama" class="row detail">
        <div class="container">
            <div class="row">
                <div class="half">
                    <div class="con-img">
                        <img class="img-res" src="{{ asset($program->image) }}">
                    </div>
                    <div class="percent" data-percent='{{ $program->fund_accumulation_percentage }}'>
                        <div class="bar blue"><span></span></div>
                    </div>
                    <a href="{{ route('programs.kontribusi', $program->program_id) }}"
                       class="btn btn-full btn-success utama">Donasi Sekarang</a>
                </div>
                <div class="col-md-6">
                    <p class="title-card">{{ $program->title }}</p>
                    <hr>
                    <div class="col-md-12 footer">
                        <div class="row">
                            <div class="col-md-12">
                                <span class="price">{{ $program->akumulasi }}</span>
                            </div>
                            <div class="col-md-6 footer-text align-left">
                                <small>Dari target {{ $program->formatted_fund_target }}</small>
                            </div>
                            <div class="col-md-6 footer-text align-right">
                                @if($program->is_continuous)
                                    <small>&infin; hari lagi</small>
                                @else
                                    <small>{{ $program->day_diff }} hari lagi</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a class="btn btn-full btn-primary fb-share"
                               href="{{ route('programs.detail', $program->program_id) }}" data-sharer="facebook"><img
                                        src="/frontend/assets/images/sosmed/fb_litle.png"> Share | <span
                                        class="social-count">0</span> kali dibagi</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <i>{{ $program->tanggal }}</i>
                    <div>
                        {!! $program->description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>
    <section id="detail-info">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="mb-5">Keterangan</h2>
                    <div class="keterangan">
                        @foreach($program->progress as $progressUpdate)
                            <div class="update-item">
                                <h2>Update {{ $loop->iteration }}</h2>
                                <p>{{ $progressUpdate->tanggal  }}</p>
                                <div class="update-item--content">
                                    {!! $progressUpdate->description !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4">
                    <h2 align="right">Donatur({{ count($program->donator) }})</h2>
                    <ul class="con-donatur">
                        @foreach($program->donator as $donator)
                            @if ($donator->hide_credential)
                                <li>
                                    <div class="con-img">
                                        <img src="/frontend/assets/images/person.png">
                                    </div>
                                    <div class="text">
                                        <div class="price">{{ $donator->rupiah }}</div>
                                        <a>Orang Baik</a><br>
                                        <i>11 April 2018</i>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            @else
                                <li>
                                    <div class="con-img">
                                        <img class="" src="{{ Gravatar::get($donator->user->email) }}">
                                    </div>
                                    <div class="text">
                                        <div class="price">{{ $donator->rupiah }}</div>
                                        <a>{{ $donator->user->getFullName() }}</a><br>
                                        <i>{{ $donator->tanggal }}</i>
                                    </div>
                                    <div class="clearfix"></div>
                                </li>
                            @endif
                        @endforeach

                        <li>
                            <a class="btn btn-primary btn-full" href="#">Tampilkan lebih banyak</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

@endsection
@section('jsCustom')
<script type="text/javascript">
    $(function(){
        var url = "{{\Illuminate\Support\Facades\URL::current()}}"
        var facebook = "http://graph.facebook.com/?id="+url
        console.log(facebook)
        $.ajax({
            url : facebook,
            type : 'GET',
            success: function(data){
                $(".social-count").text(data.share.share_count)
            }
        })
    })
</script>
@endsection