@extends('auth.app')

@section('content')

    <h4 class="fw-300 c-grey-900 mB-40">Register</h4>
    <form method="POST" action="{{ route('register') }}">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="first_name" class="text-normal text-dark">Nama Depan</label>
                    <input id="first_name" type="text" class="form-control" name="first_name" placeholder="Nama Belakang"
                           value="{{ old('first_name') }}" required autofocus>

                    @if ($errors->has('first_name'))
                        <span class="form-text text-danger">
                            <small>{{ $errors->first('first_name') }}</small>
                        </span>
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                    <label for="last_name" class="text-normal text-dark">Nama Belakang</label>
                    <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Nama Belakang"
                           value="{{ old('last_name') }}" autofocus>

                    @if ($errors->has('last_name'))
                        <span class="form-text text-danger">
                            <small>{{ $errors->first('last_name') }}</small>
                        </span>
                    @endif
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <label for="email" class="text-normal text-dark">Email</label>
            <input id="email" type="email" class="form-control" placeholder="example@email.com" name="email"
                   value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="form-text text-danger">
                    <small>{{ $errors->first('email') }}</small>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
            <label for="phone_number" class="text-normal text-dark">Nomor Telepon</label>
            <input id="phone_number" type="text" class="form-control" placeholder="+62810000000" name="phone_number"
                   value="{{ old('phone_number') }}" required>

            @if ($errors->has('phone_number'))
                <span class="form-text text-danger">
                    <small>{{ $errors->first('phone_number') }}</small>
                </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <label for="password" class="text-normal text-dark">Password</label>
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="form-text text-danger">
                    <small>{{ $errors->first('password') }}</small>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="text-normal text-dark">Confirm Password</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation"
                   required>
        </div>

        <div class="form-group">
            <div class="peers ai-c jc-sb fxw-nw">
                <div class="peer">
                    <a href="/login">I have an account</a>
                </div>
                <div class="peer">
                    <button class="btn btn-primary">Register</button>
                </div>
            </div>
        </div>
    </form>

@endsection
