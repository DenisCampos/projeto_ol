@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Novo</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('admin.atuacoes.index')}}">Atuações</a></li>
                    <li class="active">Novo</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    @if(Session::has('message'))
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Sucesso</span>  {!! Session::get('message') !!}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Nova atuação</strong>
                    </div>
                    {!! Form::open(['route' => ['admin.atuacoes.store'],'class' => 'form', 'method' => 'POST']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Atuação</h3>
                        </div>
                        <hr>
                        {!! Form::label('descricao', 'Descrição*', ['class' => 'control-label']) !!}
                        {!! Form::text('descricao', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('tipo', 'Tipo*', ['class' => 'control-label']) !!}
                        {!! Form::select('tipo', ['3' => 'Profissional/Empresa', '1' => 'Profissional', '2' => 'Empresa'], '3', ['class' => 'form-control', 'required' => 'required']) !!}
                    </div>
                    <div class="card-footer" align="center">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-block']) !!}                       
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
