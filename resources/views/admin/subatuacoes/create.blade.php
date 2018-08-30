@extends('layouts.sufee')

@section('page_name', 'Novo')

@section('breadcrumbs', Breadcrumbs::render('admin.subatuacoes.create', $atuacao))

@section('content')

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
                        <strong class="card-title">Nova subatuação</strong>
                    </div>
                    {!! Form::open(['route' => ['admin.subatuacoes.store', 'id' => $atuacao->id],'class' => 'form', 'method' => 'POST']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">SubAtuação</h3>
                        </div>
                        <hr>
                        {!! Form::label('descricao', 'Descrição*', ['class' => 'control-label']) !!}
                        {!! Form::text('descricao', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        @if($atuacao->tipo == 3)
                        {!! Form::label('tipo', 'Tipo*', ['class' => 'control-label']) !!}
                        {!! Form::select('tipo', ['3' => 'Profissional/Empresa', '1' => 'Profissional', '2' => 'Empresa'], null, ['class' => 'form-control', 'required' => 'required']) !!}
                        @endif
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
