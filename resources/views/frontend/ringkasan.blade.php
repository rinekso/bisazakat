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
                                 style="width: 100%;"></div>
                        </div>
                        <div class="f1-step activated">
                            <div class="f1-step-icon"><i class="fa fa-gift"></i></div>
                            <p>donasi</p>
                        </div>
                        <div class="f1-step activated">
                            <div class="f1-step-icon"><i class="fa fa-user"></i></div>
                            <p>info user</p>
                        </div>
                        <div class="f1-step active">
                            <div class="f1-step-icon"><i class="fa fa-money"></i></div>
                            <p>pembayaran</p>
                        </div>
                    </div>
                    <div class="m-3 text-center">
                        Anda Akan Melakukan Kontribusi untuk program
                        <h4>{{ $transaction->program->title }}</h4>
                    </div>
                    <div class="f1">
                        <h4>Ringkasan Transaksi</h4>

                        <table class="table table-responsive-md">
                            <tr>
                                <td>
                                    Nominal Transaksi
                                </td>
                                <td>
                                    Rp
                                </td>
                                <td>
                                    {{ number_format($transaction->amount - $transaction->last_digit_unique_code, 0, ",", ".") }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Kode Unik
                                </td>
                                <td>
                                    Rp
                                </td>
                                <td>
                                    {{ str_pad(number_format($transaction->last_digit_unique_code, 0, ",", "."), 3, 0, STR_PAD_LEFT) }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Total Tranksasi</h4   >
                                </td>
                                <td>
                                    <h4>Rp</h4>
                                </td>
                                <td>
                                    <h4>{{ number_format($transaction->amount, 0, ",", ".") }}</h4>
                                </td>
                            </tr>
                        </table>

                        <div class="alert alert-warning" role="alert">
                            <i class="fa fa-info-circle"></i> PENTING, transfer sampai 3 digit terakhir agar donasi Anda dapat diproses.
                        </div>
                        <div class="form-group">
                            <label for="">Silahkan Transfer Ke</label>
                            <h2>{{ $program->category->coa->bank_account }}</h2>
                            <p>Atas Nama: Yayasan Al Bunyan <br> {{ $program->category->coa->bank_name }}</p>
                        </div>
                    </div>
                    <div class="alert alert-primary mt-4">
                        <p>Pastikan bahwa Anda melakukan transfer sebelum <u>{{ \Carbon\Carbon::parse($transaction->expired_at)->format('j F Y H:i') . " WIB" }}</u></p>
                    </div>

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