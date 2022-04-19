@extends('admin.default')

@section('page-header')
  CoA <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')


    <div class="row mB-40">

        <div class="col-sm-8">

            {!! Form::open([
             'action' => ['Admin\CoAController@store'],
             'files' => false
               ])
             !!}

            <div class="bgc-white p-20 bd">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::myInput('text', 'coa_number', 'Nomor CoA') !!}
                    </div>
                    <div class="col-md-6">
                        {!! Form::myInput('text', 'bank_account', 'Nomor Rekening CoA') !!}
                    </div>
                </div>

                {!! Form::myInput('text', 'title', 'Title') !!}

                <div class="form-group">
                    <label for="">Status Aktivasi CoA</label>
                    <select name="is_active" id="" class="form-control">
                        <option value=0>Nonaktif</option>
                        <option value=1>Aktif</option>
                    </select>
                </div>

                {!! Form::myInput('text', 'description', 'Deskripsi') !!}
                {!! Form::myInput('text', 'bank_name', 'Nama Bank') !!}
                {!! Form::myInput('text', 'email', 'Email Laporan Transaksi') !!}

            </div>
            <button type="submit" class="btn btn-success">{{ trans('app.add_button') }}</button>
            <a href="{{ route('admin.coa.index')  }}" class="btn btn-primary">Batal</a>

            {!! Form::close() !!}
        </div>



    </div>


  

@stop

