<?php
$nav = "active";
$menu = 2; //zakat
$title = "Zakat Now";
?>
@extends('frontend.layout')
@section('content')
    <section id="wizard">
        <div class="container">

            <div class="row justify-content-center">

                <div class="col-md-8 form-box">
                    <form role="form" action="{{ route('zakat.transaction.initiate') }}" method="POST" class="f1">
                        {{ csrf_field() }}
                        <h3>Kalkulator Zakat</h3>
                        <p>hitung zakatmu</p>
                        @if (Session::has('warning'))
                            <div class="col-md-12 alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                {{Session::get('warning')}}
                            </div>
                        @endif
                        <div>

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a href="#profesi" class="nav-link active" aria-controls="profesi" role="tab" data-toggle="tab">Profesi</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#perdagangan" class="nav-link" aria-controls="perdagangan" role="tab" data-toggle="tab">Perdagangan</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#investasi" class="nav-link" aria-controls="investasi" role="tab" data-toggle="tab">Investasi</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#emas" class="nav-link" aria-controls="emas" role="tab" data-toggle="tab">Emas dan Perak</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a href="#hasil" class="nav-link disabled" aria-controls="hasil" role="tab" data-toggle="tab">Hasil hitung</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="profesi">
                                    <div class="form-group row">
                                        <label for="penghasilan" class="col-sm-2 col-form-label col-form-label-bg">Penghasilan</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask penghasilan" id="penghasilan" placeholder="penghasilan per bulan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="pendapatan" class="col-sm-2 col-form-label col-form-label-bg">Pendapatan Lain</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask penghasilan" id="pendapatan" placeholder="pendapatan lain (jika ada)">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="cicilan" class="col-sm-2 col-form-label col-form-label-bg">Cicilan/Hutang</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask penghasilan" id="cicilan" placeholder="cicilan/hutang (jika ada)">
                                        </div>
                                    </div>
                                    <small>Nisab 524 kg beras @Rp 10.000 (relatif)  Rp 5.240.000,-</small>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-full hitung" data-tab='penghasilan'>
                                            Hitung
                                        </a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="perdagangan">
                                    <div class="form-group row">
                                        <label for="modal" class="col-sm-2 col-form-label col-form-label-bg">Modal berputar</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask perdagangan" id="modal" placeholder="modal berputar">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="laba" class="col-sm-2 col-form-label col-form-label-bg">Laba</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask perdagangan" id="laba" placeholder="laba">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="piutang" class="col-sm-2 col-form-label col-form-label-bg">Piutang</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask perdagangan" id="piutang" placeholder="piutang">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="hutang" class="col-sm-2 col-form-label col-form-label-bg">Hutang</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask perdagangan" id="hutang" placeholder="hutang">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rugi" class="col-sm-2 col-form-label col-form-label-bg">Rugi</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask perdagangan" id="rugi" placeholder="rugi">
                                        </div>
                                    </div>
                                    <small>Nishab Zakat perdagangan adalah 85 gram emas. Jika diasumsikan harga emas hari ini sekitar Rp. 615.000, maka nishab nya setara dengan 85 gram x Rp. 615.000 = 52.275.000.</small>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-full hitung" data-tab='perdagangan'>
                                            Hitung
                                        </a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="investasi">
                                    <div class="form-group row">
                                        <label for="pendapatan" class="col-sm-2 col-form-label col-form-label-bg">Pendapatan Investasi</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask investasi" id="pendapatan" placeholder="pendapatan">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="perawatan" class="col-sm-2 col-form-label col-form-label-bg">Biaya Perawatan</label>
                                        <div class="input-group mb-2 col-sm-10">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">Rp</div>
                                            </div>
                                            <input type="text" class="form-control money-mask investasi" id="perawatan" placeholder="perawatan">
                                        </div>
                                    </div>
                                    <small>Nishab Zakat investasi adalah 524 Kilogram Beras.</small>
                                    <div class="form-group">
                                        <a href="#" class="btn btn-primary btn-full hitung" data-tab='investasi'>
                                            Hitung
                                        </a>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="emas">
                                    <p>
                                        Emas dan perak yang disimpan (tidak dipakai) wajib dizakati, sementara perhiasan emas dan perak yang biasa dipakai sehari hari dalam batas wajar tidak wajib dizakati
                                    </p>
                                    <small>Nishab emas adalah 20 dinar (setara dengan 85 gram emas murni) dan perak adalah 200 dirham (setara dengan 672 gram perak). Artinya bila seseorang telah memiliki emas sebesar 20 dinar atau perak 200 dirham dan sudah setahun, maka ia telah terkena wajib zakat, yakni sebesar 2,5 %.</small>
                                </div>
                                <input type="hidden" name="jenis_zakat" id="jenis_zakat" required>
                                <input type="hidden" name="nominal" id="nominal" required>
                                <div role="tabpanel" class="tab-pane fade" id="hasil">
                                    <h3 class="align-center zakat-hasil"></h3>
                                    <input type="text" class="money-mask zakat-hasil-num hide" disabled name="">
                                    <button id="submit-zakat" type="submit" class="btn btn-success btn-full">Zakat sekarang</button>
                                </div>
                            </div>
                        </div>

                    </form>
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
            if($(window).scrollTop() != scroll_to) {
                $('html, body').stop().animate({scrollTop: scroll_to}, 0);
            }
        }
        function bar_progress(progress_line_object, direction) {
            var number_of_steps = progress_line_object.data('number-of-steps');
            var now_value = progress_line_object.data('now-value');
            var new_value = 0;
            if(direction == 'right') {
                new_value = now_value + ( 100 / number_of_steps );
            }
            else if(direction == 'left') {
                new_value = now_value - ( 100 / number_of_steps );
            }
            progress_line_object.attr('style', 'width: ' + new_value + '%;').data('now-value', new_value);
        }
        $(function(){
            $("#profesi").tab('show')
            $(".money-mask").maskMoney({
                selectAllOnFocus: true
            });
            $(".hitung").click(function(e){
                e.preventDefault();
                var tab = $(this).attr('data-tab')
                var hasil = 0
                var zakat = 0
                var nisab = 5240000
                var text = ""
                if(tab == "penghasilan"){
                    var penghasilan = $('#penghasilan.'+tab).maskMoney('unmasked')[0]
                    var pendapatan = $('#pendapatan.'+tab).maskMoney('unmasked')[0]
                    var cicilan = $('#cicilan.'+tab).maskMoney('unmasked')[0]
                    hasil = penghasilan+pendapatan-cicilan
                    zakat = Math.floor(hasil*2.5/100)
                }else if(tab == "perdagangan"){
                    var modal = $('#modal.'+tab).maskMoney('unmasked')[0]
                    var laba = $('#laba.'+tab).maskMoney('unmasked')[0]
                    var piutang = $('#piutang.'+tab).maskMoney('unmasked')[0]
                    var hutang = $('#hutang.'+tab).maskMoney('unmasked')[0]
                    var rugi = $('#rugi.'+tab).maskMoney('unmasked')[0]
                    nisab = 85*615000
                    hasil = (modal+laba+piutang) - (hutang+rugi)
                    zakat = Math.floor(hasil*2.5/100)
                }else if(tab == "investasi"){
                    var pendapatan = $('#pendapatan.'+tab).maskMoney('unmasked')[0]
                    var perawatan = $('#perawatan.'+tab).maskMoney('unmasked')[0]
                    nisab = 5240000
                    hasil = pendapatan - perawatan
                    zakat = Math.floor(hasil*5/100)
                    console.log(zakat)
                }

                if(hasil > nisab){
                    $('#submit-zakat').show();
                    text = 'Rp. ' + zakat.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
                }else{
                    $('#submit-zakat').hide();
                    text = 'Anda belum memenuhi nisab.'
                }

                console.log(perawatan)
                $(".zakat-hasil").text(text)
                $(".zakat-hasil-num").val(zakat)

                $("#jenis_zakat").val(tab);
                $("#nominal").val(zakat);

                $('#myTabs a[href="#hasil"]').removeClass('disabled').tab('show')
            })
        })
    </script>

@endsection

