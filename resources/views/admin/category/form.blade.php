<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            <div class="row">
                <div class="col-md-6">
                    {!! Form::mySelect('coa_number', 'CoA', $coa) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::myInput('text', 'name', 'Nama Kategori') !!}
                </div>
            </div>

            {!! Form::myTextArea('description', 'Deskripsi') !!}

        </div>
    </div>
</div>