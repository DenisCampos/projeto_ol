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
                    <li><a href="
                        @if(isset($returnevent)) 
                            {{url($returnevent)}}
                        @else 
                            {{URL::previous()}} 
                        @endif
                    ">Eventos</a></li>
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
                    @if(isset($evento->imagem1)!="")
                        <img class="card-img-top img-responsive" src="{{ asset($evento->imagem1) }}"    alt="Card image cap">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title mb-3 text-center"><strong>{{$evento->titulo}}</strong></h2>
                        <p class="card-text">
                            @foreach($categorias as $categoria)
                                <strong>{{$categoria->categoria->descricao}}</strong> / 
                            @endforeach
                        </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-comment-o"></i> <strong>Descrição (escrito pelo autor):</strong><br> {{$evento->descricao}} 
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-lg-6">
                                    <i class="fa fa-calendar"></i> <strong>Inicio:<br></strong> {{$evento->data_inicio}} 
                                </div>
                                <div class="col-lg-6">
                                    <i class="fa fa-calendar"></i> <strong>Fim:<br></strong> {{$evento->data_fim}} 
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-lg-6">
                                    <i class="fa fa-phone"></i> {{$evento->contato}} 
                                </div>
                                <div class="col-lg-6">
                                    <i class="fa fa-money"></i> {{$evento->investimento}} 
                                </div>
                            </li>
                            @if($evento->site!="")
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-laptop"></i> <strong>Site:</strong><br> {{$evento->site}}
                                </div>
                            </li>
                            @endif
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-building-o"></i> <strong>Endereço:</strong><br> {{$evento->endereco}} {{$evento->numero}} {{$evento->bairro}} {{$evento->complemento}}
                                </div>
                            </li>
                            @if($evento->pais!="" && $evento->estado!="" && $evento->cidade!="")
                            <li class="list-group-item">
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>País:</strong><br> {{$evento->pais->descricao}}
                                </div>
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>Estado:</strong><br>  {{$evento->estado->descricao}}
                                </div>
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>Cidade:</strong><br>  {{$evento->cidade->descricao}}
                                </div>
                            </li>
                            @endif
                            @if($evento->latitude!="")
                            <li class="list-group-item">
                                <div class="col-lg-12" style="height:400px" id="map"></div>
                            </li>
                            @endif
                            @if($evento->facebook!="" || $evento->twitter!="" || $evento->instagram!="")
                            <li class="list-group-item">
                                @if($evento->facebook!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social facebook" onclick="window.open('{{$evento->facebook}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-facebook"></i>
                                        <span>Facebook</span>
                                    </button>
                                </div>
                                @endif
                                @if($evento->twitter!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social twitter" onclick="window.open('{{$evento->twitter}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-twitter"></i>
                                        <span>Twitter</span>
                                    </button>
                                </div>
                                @endif
                                @if($evento->instagram!="")
                                <div class="col-lg-4">
                                    <button type="button" class="btn social instagram" onclick="window.open('{{$evento->instagram}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-instagram"></i>
                                        <span>Instagram</span>
                                    </button>
                                </div>
                                @endif
                            </li>
                            @endif
                            <li class="list-group-item">
                                <div class="col-lg-12 text-center">
                                    {!! Form::open(['route' => ['admin.eventos.adminedit', 'id' => $evento->id],'class' => 'form', 'method' => 'POST']) !!}
                                        {!! Form::hidden('returnevent', URL::previous()) !!}
                                        {!! Form::hidden('redirect_to', URL::current()) !!}
                                        <button type="submit" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i> Editar informações do evento</button>
                                    {!! Form::close() !!}
                                </div>
                            </li>
                        </ul>
                    </div>
                    @if($evento->situacao_id==2)
                    <div class="card-footer">
                        {!! Form::model($evento,['route' => ['admin.eventos.analise'],'class' => 'form', 'method' => 'PUT', 'name' => 'form_parecer', 'id' => 'form_parecer']) !!}
                        {!! Form::hidden('id', $evento->id) !!}
                        {!! Form::hidden('user_id', $evento->user_id) !!}
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
            @if(isset($evento->imagem2)!="")
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        @if(isset($evento->imagem2)!="")
                        <div class="col-lg-12">
                            <img class="card-img-top" src="{{ asset($evento->imagem2) }}"   alt="Card image cap">
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
@if($evento->latitude!="")
<script>
    function initMap() {

        var myLatLng = {lat: {{$evento->latitude}}, lng: {{$evento->longitude}}};
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
