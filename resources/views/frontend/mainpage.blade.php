<?php
$menu = 0; //beranda
$title = "Home";
?>
@extends('frontend.layout')

@section('og.meta')
    <meta property="og:url" content={{ URL::to('/') }} />
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="Semua bisa Zakat | Home"/>
    <meta property="og:description"
          content="LAZ Al Bunyan berkipah dimulai sejak dikeluarkannya Surat Keputusan Yayasan, tertanggal 1 November 2001, Namun jauh sebelumnya sudah dimulai pembahasan dan gagasan dari para pendiri. Mereka adalah kelompok pemuda yang memiliki visi sosial dan dakwah yang hendak berkontribusi untuk masyarakat Bogor d…"/>
    <meta property="og:image" content="https://staging.bisazakat.pw/frontend/assets/images/logo_blue_shape.png"/>
    <meta property="fb:app_id" content="171785850192034"/>
@endsection

@section('content')
    <header>
        <!-- Slidder -->
        <div class="slider-wrapper theme-dark">
            <div id="slider" class="nivoSlider">
                <img src="/frontend/assets/images/1.jpg" alt="" title="#slide1"/>
                <img src="/frontend/assets/images/2.jpg" alt="" title="#slide2"/>
                <img src="/frontend/assets/images/3.jpg" alt="" title="#slide3"/>
                <img src="/frontend/assets/images/4.jpg" alt="" title="#slide4"/>
                <img src="/frontend/assets/images/5.jpg" alt="" title="#slide5"/>
                <img src="/frontend/assets/images/6.jpg" alt="" title="#slide"/>
            </div>
           {{-- <div id="slide1" class="nivo-html-caption">
                <div class="container">
                    <div class="title-big">
                        <div class="text">
                            <h1><span class="text-primary">Bantu</span> Sesama</h1>
                            <small>Disaat mereka <span class="text-primary">membutuhkan</span></small>
                        </div>
                    </div>
                </div>
            </div>--}}
        </div>
    </header>
    <section id="total">
        <div class="container">
            <div class="row">
                <div class="col-md-4 align-center">
                    <div class="circle"><i class="fa fa-user"></i></div>
                    <h1>{{ count($users) }}</h1>
                    <small>Total Donatur</small>
                </div>
                <div class="col-md-4 align-center">
                    <div class="circle"><i class="fa fa-money"></i></div>
                    <h2>Rp{{ number_format($transactionTotal, 0, '.', ',') }}</h2>
                    <small>Total Donasi</small>
                </div>
                <div class="col-md-4 align-center">
                    <div class="circle"><i class="fa fa-newspaper-o"></i></div>
                    <h1>{{ \App\Models\Program::getTotalProgram() }}</h1>
                    <small>Total Program</small>
                </div>
            </div>
        </div>
    </section>
    <section id="utama" class="row detail home">
        <div class="container">
            <div class="row">
                <div class="half">
                    <div class="con-img">
                        <img class="img-res" src="{{ asset($mainProgram->image) }}">
                    </div>

                    @if($mainProgram->is_targeted)
                        <div class="percent" data-percent='{{ $mainProgram->fund_accumulation_percentage }}'>
                            <div class="bar blue"><span></span></div>
                        </div>
                    @endif

                    <a class="btn btn-full btn-primary utama"
                       href="{{ route('programs.kontribusi', $mainProgram->program_id) }}">Donasi Sekarang</a>
                </div>
                <div class="col-md-6">
                    <h3 class="bg-primary">PROGRAM UNGGULAN</h3>
                    <p class="title-card">{{ $mainProgram->title }}</p>
                    <i>{{ $mainProgram->tanggal }}</i>
                    <p>{!! str_limit($mainProgram->description, 200, ' ...') !!}</p>
                    <hr>
                    <span class="price">{{ $mainProgram->akumulasi }}</span>
                    <br>
                    @if($mainProgram->is_continuous)
                        <small>Terkumpul dari target {{ $mainProgram->formatted_fund_target }} | sisa
                            : &infin; hari lagi
                        </small>

                    @else
                        <small>Terkumpul dari target {{ $mainProgram->formatted_fund_target }} | sisa
                            : {{ $mainProgram->day_diff }} hari lagi
                        </small>
                    @endif
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ route('programs.detail', $mainProgram->program_id) }}"
                               class="btn btn-100 btn-success" href="detail.html">Detail</a>
                            <a class="btn btn-primary btn-100"
                               href="{{ route('programs.detail', $mainProgram->program_id) }}"
                               data-sharer="facebook"><img src="/frontend/assets/images/sosmed/fb_litle.png"> |
                                Share</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 footer">
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
    <section id="info">
        <div class="cover">
            <div class="container">
                <div class="row justify-content-center content">
                    <div class="col-md-12 align-center">
                        <img src="/frontend/assets/images/logo_blue_shape.png" class="logo">
                    </div>
                    <div class="col-md-8 align-center">
                        <p>LAZ Al Bunyan berkipah dimulai sejak dikeluarkannya Surat Keputusan Yayasan, tertanggal 1
                            November 2001, Namun jauh sebelumnya sudah dimulai pembahasan dan gagasan dari para pendiri.
                            Mereka adalah kelompok pemuda yang memiliki visi sosial dan dakwah yang hendak berkontribusi
                            untuk masyarakat Bogor dan sekitarnya. Dengan sifat amanah, kepercayaan dan kerja antusias
                            dari semua stakeholder maka PMA menjadi berkembang sampai saat ini dan sudah diterima di
                            masyarakat.<br><br>

                            Pendirian secara formal bermana Pos Mustahik Albunyan, secara otonom berada di bawah lembaga
                            dakwah dan sosial Yayasan Albunyan Bogor. Dengan Notaris Buhari, S.H. nomor 18 tanggal 26
                            November 1999.<br><br>

                            Pijakan hukum yang digunakan adalah SK Walikota Bogor No. 451.12-198 Tahun 2003 sebagai
                            Lembaga Amil Zakat (LAZ). Serta SK MENHUKAM RI No. C.3840 HT.01.02. Tahun 2007 dengan nama
                            Yayasan Albunyan.</p>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="search">
                        <form>
                            <button type="submit"><i class="fa fa-search"></i></button>
                            <input type="text" name="" placeholder="Cari campaign, judul, atau nama">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- campaign donasi -->
    <section id="donasi">
        <div class="container">
            <div class="title">
                <h1>Program Terbaru</h1>
            </div>
            <div class="con-donasi">
                <div class="row">
                    @foreach($latestProgram as $program)
                        <div class="col-md-4">
                            <div class="donasi-card">
                                <div class="con-img">
                                    <img class="img-res" src="{{ asset($program->image) }}">
                                </div>
                                @if($program->is_targeted)
                                    <div class="percent" data-percent='{{ $program->fund_accumulation_percentage }}'>
                                        <div class="bar blue"><span></span></div>
                                    </div>
                                    <p class="title-card">{{ $program->title }}</p>
                                @else
                                    <p class="title-card mt-3">{{ $program->title }}</p>
                                @endif

                                <div class="col-md-12">
                                    <div class="half">
                                        <a href="{{ route('programs.kontribusi', $program->program_id) }}"
                                           class="btn btn-full btn-primary">Bantu</a>
                                    </div>
                                    <div class="half">
                                        <a href="{{ route('programs.detail', $program->program_id) }}"
                                           class="btn btn-full btn-success" href="detail.html">Detail</a>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-md-12 footer">
                                    <div class="row">
                                        <div class="col-md-6 footer-text align-left">
                                            <small>Tercapai</small>
                                            <span>{{ $program->akumulasi }}</span>
                                        </div>
                                        <div class="col-md-6 footer-text align-right">
                                            <small>Sisa hari</small>
                                            @if(!$program->is_continuous)
                                                <span>{{ $program->day_diff }} hari lagi</span>
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
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <a href="{{ route('programs.donasi') }}" class="btn btn-primary btn-full">Campaign Lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('jsCustom')
    <script type="text/javascript">
        $(function () {
            $("#slider").nivoSlider();
        });
        $(window).scroll(function () {
            let scrollTop = $(window).scrollTop();
            if (scrollTop > 35) {
                $("nav").addClass('active');
            } else {
                $("nav").removeClass('active');
            }
        });
    </script>
@endsection