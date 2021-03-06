@extends('layouts.sufee')

@section('page_name', $curso->titulo)

@section('breadcrumbs', Breadcrumbs::render('cursos.show', $curso))

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
    @if(!is_null($parecer))
    <div class="row">
        <div class="col-sm-12">
            @php
            if($parecer->situacao_id=='4'){
                $css = "alert-danger";
                $destaque = "badge-danger";
            }else{
                $css = "alert-success";
                $destaque = "badge-success";
            }
            @endphp
            <div class="alert {{$css}} alert-dismissible fade show" role="alert">
                <span class="badge badge-pill {{$destaque}}">Parecer</span>  {{$parecer->parecer}}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    @if(isset($curso->imagem1)!="")
                        <img class="card-img-top img-responsive" src="{{ asset($curso->imagem1) }}"    alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title mb-3">{{$curso->name}}</h4>
                        <p class="card-text">
                            @foreach($categorias as $categoria)
                                <strong>{{$categoria->categoria->descricao}}</strong> / 
                            @endforeach
                        </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="col-lg-12 text-center">
                                    <h2><strong>{{$curso->titulo}}</strong></h2><br>
                                    {{$curso->sub_titulo}}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-comment-o"></i> <strong>Descrição (escrito pelo autor):</strong><br> {!!$curso->descricao!!}
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-lg-6">
                                    <i class="fa fa-calendar"></i> <strong>Inicio:<br></strong> {{$curso->data_inicio}} 
                                </div>
                                <div class="col-lg-6">
                                    <i class="fa fa-calendar"></i> <strong>Fim:<br></strong> {{$curso->data_fim}} 
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-lg-6">
                                    <i class="fa fa-phone"></i> {{$curso->contato}} 
                                </div>
                                <div class="col-lg-6">
                                    <i class="fa fa-money"></i> {{$curso->investimento}} 
                                </div>
                            </li>
                            @if($curso->link!="")
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <a href="{{$curso->link}}" target="_blank"><i class="fa fa-shopping-cart"></i> <strong>Link para compra:</strong><br> {{$curso->link}}</a>
                                </div>
                            </li>
                            @endif
                            @if($curso->site!="")
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <a href="{{$curso->site}}" target="_blank"><i class="fa fa-laptop"></i> <strong>Site:</strong><br> {{$curso->site}}</a>
                                </div>
                            </li>
                            @endif
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-building-o"></i> <strong>Endereço:</strong><br> {{$curso->endereco}} {{$curso->numero}} {{$curso->bairro}} {{$curso->complemento}}
                                </div>
                            </li>
                            @if($curso->pais!="" && $curso->estado!="" && $curso->cidade!="")
                            <li class="list-group-item">
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>País:</strong><br> {{$curso->pais->descricao}}
                                </div>
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>Estado:</strong><br>  {{$curso->estado->descricao}}
                                </div>
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>Cidade:</strong><br>  {{$curso->cidade->descricao}}
                                </div>
                            </li>
                            @endif
                            <li class="list-group-item">
                                @if($curso->facebook!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social facebook" onclick="window.open('{{$curso->facebook}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-facebook"></i>
                                        <span>Facebook</span>
                                    </button>
                                </div>
                                @endif
                                @if($curso->twitter!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social twitter" onclick="window.open('{{$curso->twitter}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-twitter"></i>
                                        <span>Twitter</span>
                                    </button>
                                </div>
                                @endif
                                @if($curso->instagram!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social instagram" onclick="window.open('{{$curso->instagram}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-instagram"></i>
                                        <span>Instagram</span>
                                    </button>
                                </div>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @if(isset($curso->imagem2)!="")
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if(isset($curso->imagem2)!="")
                        <div class="col-lg-12">
                            <img class="card-img-top" src="{{ asset($curso->imagem2) }}"   alt="Card image cap">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div> <!-- .content -->
@endsection
