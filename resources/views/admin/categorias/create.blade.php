@extends('layouts.sufee')

@section('page_name', 'Novo')

@section('breadcrumbs', Breadcrumbs::render('admin.categorias.create'))

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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Nova categoria</strong>
                    </div>
                    {!! Form::open(['route' => ['admin.categorias.store'],'class' => 'form', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Categoria</h3>
                        </div>
                        <hr>
                        {!! Form::label('descricao', 'Descrição*', ['class' => 'control-label']) !!}
                        {!! Form::text('descricao', null, ['class' => 'form-control', 'required' => 'required']) !!}
                        {!! Form::label('tipo', 'Tipo*', ['class' => 'control-label']) !!}
                        {!! Form::select('tipo', [
                            '15' => 'Todos', 
                            '1' => 'Para Você', 
                            '2' => 'Para Profissional', 
                            '3' => 'Para Empresa', 
                            '4' => 'Você/Profissional', 
                            '5' => 'Você/Empresa', 
                            '6' => 'Profissional/Empresa', 
                            '7' => 'Para Evento',
                            '8' => 'Você/Evento',
                            '9' => 'Profissional/Evento',
                            '10' => 'Empresa/Evento',
                            '11' => 'Você/Profissional/Evento',
                            '12' => 'Você/Empresa/Evento',
                            '13' => 'Profissional/Empresa/Evento',
                            '14' => 'Você/Profissional/Empresa'],
                        '15', ['class' => 'form-control', 'required' => 'required']) !!}

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
