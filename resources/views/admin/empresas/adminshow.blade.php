@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Detalhar</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('admin.usuarios.index')}}">Usuários</a></li>
                    <li><a href="{{route('admin.usuarios.edit',['id' => $empresa->user_id])}}">Detalhar</a></li>
                    <li><a href="{{route('admin.empresas.useremps',['id' => $empresa->user_id])}}">Empresas</a></li>
                    <li class="active">Detalhar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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
                    @if(isset($empresa->imagem1)!="")
                        <img class="card-img-top img-responsive" src="{{ asset($empresa->imagem1) }}"    alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h4 class="card-title mb-3">{{$empresa->name}}</h4>
                        <p class="card-text">
                            @foreach($atuacoes as $atuacao)
                                <strong>{{$atuacao->atuacao->descricao}}</strong> / 
                            @endforeach
                            @foreach($subatuacoes as $subatuacao)
                                {{$subatuacao->subatuacao->descricao}} /   
                            @endforeach
                        </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="col-lg-6">
                                    <i class="fa fa-envelope-o"></i> {{$empresa->email}}
                                </div>
                                <div class="col-lg-6">
                                    <i class="fa fa-phone"></i> {{$empresa->contato}} 
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-comment-o"></i> <strong>Descrição (escrito pelo autor):</strong><br> {{$empresa->descricao}} 
                                </div>
                            </li>
                            @if($empresa->site!="")
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-laptop"></i> <strong>Site:</strong><br> {{$empresa->site}}
                                </div>
                            </li>
                            @endif
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-hospital-o"></i> <strong>Endereço:</strong><br> {{$empresa->endereco}} {{$empresa->numero}} {{$empresa->bairro}} {{$empresa->complemento}}
                                </div>
                            </li>
                            @if($empresa->pais!="" && $empresa->estado!="" && $empresa->cidade!="")
                            <li class="list-group-item">
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>País:</strong><br> {{$empresa->pais->descricao}}
                                </div>
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>Estado:</strong><br>  {{$empresa->estado->descricao}}
                                </div>
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>Cidade:</strong><br>  {{$empresa->cidade->descricao}}
                                </div>
                            </li>
                            @endif
                            @if($empresa->latitude!="")
                            <li class="list-group-item">
                                <div class="col-lg-12" style="height:400px" id="map"></div>
                            </li>
                            @endif
                            @if($empresa->facebook!="" || $empresa->twitter!="" || $empresa->instagram!="")
                            <li class="list-group-item">
                                @if($empresa->facebook!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social facebook" onclick="window.open('{{$empresa->facebook}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-facebook"></i>
                                        <span>Facebook</span>
                                    </button>
                                </div>
                                @endif
                                @if($empresa->twitter!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social twitter" onclick="window.open('{{$empresa->twitter}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-twitter"></i>
                                        <span>Twitter</span>
                                    </button>
                                </div>
                                @endif
                                @if($empresa->instagram!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social instagram" onclick="window.open('{{$empresa->instagram}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-instagram"></i>
                                        <span>Instagram</span>
                                    </button>
                                </div>
                                @endif
                            </li>
                            @endif
                        </ul>
                    </div>
                    @if($empresa->situacao_id==2)
                    <div class="card-footer">
                        {!! Form::model($empresa,['route' => ['admin.empresas.analise'],'class' => 'form', 'method' => 'PUT', 'name' => 'form_parecer', 'id' => 'form_parecer']) !!}
                        {!! Form::hidden('id', $empresa->id) !!}
                        {!! Form::hidden('user_id', $empresa->user_id) !!}
                        {!! Form::hidden('analise', '', ['id' => "analise"]) !!}
                        <div class="col-lg-12">
                            {!! Form::label('parecer', 'Parecer*', ['class' => 'control-label']) !!}
                            {!! Form::textarea('parecer', null, ['rows' => "3",'class' => 'form-control', 'required' => 'required']) !!}<br>
                        </div>
                        <div class="col-lg-6 text-center">
                            <button type="buttom" class="btn btn-danger" onclick="coloca_analise('4')"><i class="fa fa-ban"></i> Negar</button>
                        </div>
                        <div class="col-lg-6 text-center">
                            <button type="buttom" class="btn btn-success" onclick="coloca_analise('3')"><i class="fa fa-check"></i> Aceitar</button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    @endif
                </div>
            </div>
            @if(isset($empresa->imagem2)!="" || isset($empresa->imagem3)!="")
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if(isset($empresa->imagem2)!="")
                        <div class="col-lg-12">
                            <img class="card-img-top" src="{{ asset($empresa->imagem2) }}"   alt="Card image cap">
                        </div>
                        @endif
                        @if(isset($empresa->imagem3)!="")
                        <div class="col-lg-12">
                            <img class="card-img-top" src="{{ asset($empresa->imagem3) }}"  alt="Card image cap">
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div> <!-- .content -->
<script>
    function coloca_analise(pvalor){
        $("#analise").val(pvalor);
    }
</script>
@if($empresa->latitude!="")
<script>
    function initMap() {

        var myLatLng = {lat: {{$empresa->latitude}}, lng: {{$empresa->longitude}}};
        var count_marker = 0;

        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 15,
        center: myLatLng
        });

        var marker = new google.maps.Marker({
            position: myLatLng,
            map: map,
            id: 1
        });

    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2UTdk-E7kWhTX-YUDQXUVc5FnQiaYIuA&callback=initMap" type="text/javascript"></script>
@endif
@endsection
