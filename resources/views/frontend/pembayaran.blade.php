<?php
$nav = "active";
$menu = 1; //program
$title = "Donasi";
?>
@extends('frontend.layout')
@section('content')
    <section id="wizard">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-6 form-box">


                    <h3>Langkah Donasi</h3>
                    <p>penuhi semua langkah</p>
                    <div class="f1-steps">
                        <div class="f1-progress">
                            <div class="f1-progress-line" data-now-value="16.66" data-number-of-steps="3"
                                 style="width: 50%;"></div>
                        </div>
                        <div class="f1-step activated">
                            <div class="f1-step-icon"><i class="fa fa-gift"></i></div>
                            <p>donasi</p>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            <p>info user</p>
                        </div>
                        <div class="f1-step">
                            <div class="f1-step-icon"><i class="fa fa-money"></i></div>
                            <p>pembayaran</p>
                        </div>
                    </div>

                    @if(!auth()->check())
                    <form role="form" action="{{ route('programs.kontribusi.createTransactionWithoutLogin', $program->program_id) }}" method="post" class="f1">

                        {{ csrf_field() }}
                        <h4>Informasi Anda</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('auth.social', ['facebook', 'redirect_page' => url()->current()]) }}" class="btn btn-primary btn-full">Login Facebook</a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('auth.social', ['google', 'redirect_page' => url()->current()]) }}" class="btn btn-danger btn-full">Login Google+</a>
                            </div>
                        </div>
                        <div class="space">
                            <div class="border"></div>
                            <span>Atau</span>
                        </div>
                        <div class="form-group">
                            <label class="">Nama</label>
                            <input type="text" name="full_name" placeholder="Nama Lengkap" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="">No. Telp</label>
                            <input type="text" name="phone_number" placeholder="08XXXXXXX" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="" for="f1-email">Email</label>
                            <input type="email" name="email" placeholder="example@example" class="form-control">
                        </div>
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" name="hide_credential" value=1 class="custom-control-input" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing">Jangan tampilkan nama
                                saya</label>
                        </div>
                        <div class="f1-buttons">
                            <button type="button" class="btn btn-previous">Previous</button>
                            <button type="submit" class="btn btn-next">Next</button>
                        </div>
                    </form>
                    @else
                    <div class="f1">
                        <h4>Informasi Anda</h4>
                        <hr>
                        <div class="form-group">
                            <label for="">Nama</label>
                            <p>{{ auth()->user()->getFullName() }}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <p>{{ auth()->user()->email }}</p>
                        </div>
                        <form action="{{ route('programs.kontribusi.createTransaction', $program->program_id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" name="hide_credential" value=1 class="custom-control-input" id="customControlAutosizing">
                                <label class="custom-control-label" for="customControlAutosizing">Jangan tampilkan nama
                                    saya</label>
                            </div>
                            <div class="f1-buttons mt-5">
                                <a href="{{ route('programs.kontribusi', $program->program_id) }}" class="btn btn-previous bg-dark">Previous</a>
                                <button type="submit" class="btn btn-next">Next</button>
                            </div>
                        </form>
                    </div>
                    @endif

                </div>
            </div>

        </div>
    </section>

@endsection
@section('jsCustom')
    <script src="/frontend/assets/vendor/jquery-maskmoney-master/dist/jquery.maskMoney.min.js"></script>
    <script type="text/javascript">
        function scroll_to_class(element_class, removed_height) {
            var scroll_to = $(element_class).offset().top - removed_height;
            if ($(window).scrollTop() != scroll_to) {
                $('html, body').stop().animate({scrollTop: scroll_to}, 0);
            }
        }

        function bar_progress(progress_line_object, direction) {
            var number_of_steps = progress_line_object.data('number-of-steps');
            var now_value = progress_line_object.data('now-value');
            var new_value = 0;
            if (direction == 'right') {
                new_value = now_value + (100 / number_of_steps);
            }
            else if (direction == 'left') {
                new_value = now_value - (100 / number_of_steps);
            }
            progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
        }

        $(function () {
            $(".money").maskMoney({
                precision: 0
            });
            $('.f1 fieldset:first').fadeIn('slow');

            $('.f1 input[type="text"], .f1 input[type="password"], .f1 textarea').on('focus', function () {
                $(this).removeClass('input-error');
            });

            // next step
            $('.f1 .btn-next').on('click', function () {
                var parent_fieldset = $(this).parents('fieldset');
                var next_step = true;
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                // fields validation
                parent_fieldset.find('input[type="text"], input[type="password"], input[type="email"], textarea').each(function () {
                    if ($(this).val() == "") {
                        $(this).addClass('input-error');
                        next_step = false;
                    }
                    else {
                        $(this).removeClass('input-error');
                    }
                });
                // fields validation

                if (next_step) {
                    parent_fieldset.fadeOut(400, function () {
                        // change icons
                        current_active_step.removeClass('active').addClass('activated').next().addClass('active');
                        // progress bar
                        bar_progress(progress_line, 'right');
                        // show next step
                        $(this).next().fadeIn();
                        // scroll window to beginning of the form
                        scroll_to_class($('.f1'), 20);
                    });
                }

            });

            // previous step
            $('.f1 .btn-previous').on('click', function () {
                // navigation steps / progress steps
                var current_active_step = $(this).parents('.f1').find('.f1-step.active');
                var progress_line = $(this).parents('.f1').find('.f1-progress-line');

                $(this).parents('fieldset').fadeOut(400, function () {
                    // change icons
                    current_active_step.removeClass('active').prev().removeClass('activated').addClass('active');
                    // progress bar
                    bar_progress(progress_line, 'left');
                    // show previous step
                    $(this).prev().fadeIn();
                    // scroll window to beginning of the form
                    scroll_to_class($('.f1'), 20);
                });
            });

            // submit
            $('.f1').on('submit', function (e) {

                // fields validation
                $(this).find('input[type="text"], input[type="password"], input[type="email"], textarea').each(function () {
                    if ($(this).val() == "") {
                        e.preventDefault();
                        $(this).addClass('input-error');
                    }
                    else {
                        $(this).removeClass('input-error');
                    }
                });
                // fields validation

            });
        })
    </script>

@endsection