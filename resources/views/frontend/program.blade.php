<?php
$nav = "active";
$menu = 1; //program
$title = "Program Donasi";
?>
@extends('frontend.layout')
@section('content')
    <!-- campaign donasi -->
    <section id="donasi" class="detail">
        <div class="container">
            <div class="title">
                <h1>Program Terbaru</h1>
            </div>
            <div class="con-donasi">
                <div class="row">
                    @foreach($programs as $program)
                    <div class="col-md-4">
                        <div class="donasi-card" style="min-height: 450px">
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
                                    <a href="{{ route('programs.kontribusi', $program->program_id) }}" class="btn btn-full btn-primary">Bantu</a>
                                </div>
                                <div class="half">
                                    <a class="btn btn-full btn-success" href="{{ route('programs.detail', $program->program_id) }}">Detail</a>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="col-md-12 footer">
                                <div class="row">
                                    <div class="col-6 footer-text align-left">
                                        <small>Tercapai</small>
                                        <span>{{ $program->akumulasi }}</span>
                                    </div>
                                    <div class="col-6 footer-text align-right">
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
                        {{ $programs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection