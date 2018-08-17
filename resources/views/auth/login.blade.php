@extends('layouts.sufeelogin')

@section('content')
<div class="container">
    <div class="login-content">
        <div class="login-logo">
            <img class="align-content" src="{{ asset('public/images/cropped-oloyfit-logo.png') }}" alt="">
        </div>
        <div class="login-form">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
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
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Lembrar de mim
                    </label>
                    <label class="pull-right">
                        <a href="{{ route('password.request') }}">Esqueceu a senha?</a>
                    </label>

                </div>
                <div class="social-login-content">
                    <div class="social-button">
                        <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Login</button>
                    </div>
                </div>
                <div class="register-link m-t-15 text-center">
                    <p>Não tem conta? <a href="{{ route('register') }}">Registre-se aqui</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection