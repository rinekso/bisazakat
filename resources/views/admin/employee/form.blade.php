<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            <div class="row">
                <div class="col-md-6">
                    {!! Form::myInput('text', 'first_name', 'Nama Depan') !!}
                </div>
                <div class="col-md-6">
                    {!! Form::myInput('text', 'last_name', 'Nama Akhir') !!}
                </div>
            </div>

            {!! Form::myInput('text', 'phone_number', 'Phone Number') !!}

            {!! Form::myInput('email', 'email', 'Email') !!}

            {!! Form::myInput('password', 'password', 'Password') !!}

            {!! Form::myInput('password', 'password_confirmation', 'Password again') !!}

            {!! Form::myTextArea('address', 'Alamat') !!}
        </div>
    </div>
</div>