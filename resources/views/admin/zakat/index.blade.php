@extends('admin.default')

@section('page-header')
    Zakat <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')

<div class="row">
    @foreach($zakat as $item)
    <div class="col-md-4">
            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h6>Zakat</h6>
                <p class="font-weight-light" style="font-size: 18pt; line-height: 10px">{{ $item->title }}</p>
                <hr>
                <small>Terkumpul</small>
                <h5 class="font-weight-light">{{ $item->akumulasi }}</h5>
                <a href="{{ route('admin.programs.show', $item->program_id) }}" class="btn btn-primary mT-5">Laporan</a>
            </div>
    </div>
    @endforeach

</div>

@endsection