@extends('auth.app')

@section('content')
<h2 class="fw-300 c-grey-900 mB-40">Reset Password</h2>
<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="text-normal text-dark">Email</label>
        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

        @if ($errors->has('email'))
            <span class="form-text text-danger">
                    <small>{{ $errors->first('email') }}</small>
                </span>
        @endif
    </div>


    <div class="form-group">
        <div class="peers ai-c jc-sb fxw-nw">
            <div class="peer">
            <div class="peer">
                <button class="btn btn-primary">Send Password Reset Link</button>
            </div>
        </div>
    </div>
</form>
@endsection
