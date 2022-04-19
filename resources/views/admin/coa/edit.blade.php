@extends('admin.default')

@section('page-header')
  CoA <small>{{ trans('app.update_item') }}</small>
@stop

@section('content')

    <div class="row mB-40">
        <div class="col-sm-8">
            {!! Form::model($item, [
                'action' => ['Admin\CoAController@update', $item->coa_number],
                'method' => 'put',
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

                {!! Form::myInput('text', 'description', 'Deskripsi') !!}

                {!! Form::myInput('text', 'bank_name', 'Nama Bank') !!}
                {!! Form::myInput('text', 'email', 'Email Laporan Transaksi') !!}



            </div>
            <div class="mT-20">
                <a href="{{ route('admin.coa.index')  }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success">{{ trans('app.edit_button') }}</button>
            </div>


            {!! Form::close() !!}

        </div>

        <div class="col-sm-4">
            {!! Form::model($item, [
               'action' => ['Admin\CoAController@updateActivationStatus', $item->coa_number],
               'method' => 'put',
               'files' => false
             ])
            !!}
            <div class="bgc-white p-20 bd">
                <div class="row">
                    <div class="col-md-12">
                        <label for="">Status Aktivasi CoA</label>
                        <select name="is_active" id="" class="form-control">
                            <option value=0 <?= (!$item->is_active) ? " selected" : ""?>>Nonaktif</option>
                            <option value=1 <?= ($item->is_active) ? " selected" : ""?>>Aktif</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="mT-20">
                <a href="{{ route('admin.coa.index')  }}" class="btn btn-primary">Batal</a>
                <button type="submit" class="btn btn-success">{{ trans('app.edit_button') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>



@stop

