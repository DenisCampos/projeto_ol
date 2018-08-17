@extends('layouts.sufeelogin')

@section('content')
<div class="container">
    <div class="login-content">
        <div class="login-logo">
            <img class="align-content" src="{{ asset('public/images/cropped-oloyfit-logo.png') }}" alt="">
        </div>
        <div class="login-form">
            @if (session('status'))
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success">Sucesso</span>  {{ session('status') }}.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
            @endif
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary btn-flat m-b-15">Enviar link para resetar a senha</button>

            </form>
        </div>
    </div>
</div>


@endsection