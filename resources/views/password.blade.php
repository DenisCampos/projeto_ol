@extends('layouts.sufee')

@section('page_name', 'Alterar Senha')

@section('breadcrumbs', Breadcrumbs::render('password'))

@section('content')

<div class="content mt-3">
    @if(Session::has('message'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Sucesso</span>  {!! Session::get('message') !!}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Atualize sua senha</strong>
                    </div>
                    {!! Form::open(['route' => ['passwordupdate'],'class' => 'form', 'method' => 'PUT']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Senha</h3>
                        </div>
                        <hr>
                        {!! Form::password('password', ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                    <div class="card-footer" align="center">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-block']) !!}                       
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
@endsection
