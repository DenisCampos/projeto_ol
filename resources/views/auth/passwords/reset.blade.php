@extends('layouts.sufeelogin')

@section('content')
<div class="container">
    <div class="login-content">
        <div class="login-logo">
            <img class="align-content" src="{{ asset('public/images/cropped-oloyfit-logo.png') }}" alt="">
        </div>
        <div class="login-form">
            <form method="POST" action="{{ route('password.request') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Senha">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Confirme a Senha</label>
                    <input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" required placeholder="Confirmar Senha">
                    @if ($errors->has('password_confirmation'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="social-login-content">
                    <div class="social-button">
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Alterar Senha</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection