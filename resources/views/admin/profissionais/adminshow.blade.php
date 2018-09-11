@extends('layouts.sufee')

@section('page_name', $profissional->name)

@section('breadcrumbs', Breadcrumbs::render('admin.profissionais.adminshow', $usuario, $profissional))

@section('content')

<div class="content mt-3">
    @if(Session::has('message'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Sucesso</span>  {!! Session::get('message') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-6">
                <aside class="profile-nav alt">
                    <section class="card">
                        <div class="card-header user-header alt bg-dark">
                            <div class="media">
                                @if(isset($profissional->foto)!="")
                                    <img class="align-self-center rounded-circle mr-3" src="{{ asset($profissional->foto) }}"  style="width:85px; height:85px;"  alt="Card image cap">
                                @else
                                    <img class="align-self-center rounded-circle mr-3" src="{{ asset('public/images/oloyfit-logo3.png') }}" style="width:85px; height:85px;" alt="Card image cap">
                                @endif
                                <div class="media-body">
                                    <h2 class="text-light display-6">{{$profissional->name}}</h2>
                                    <p>
                                    @foreach($atuacoes as $atuacao)
                                       <strong>{{$atuacao->atuacao->descricao}}</strong> /  
                                    @endforeach
                                    @foreach($subatuacoes as $subatuacao)
                                       {{$subatuacao->subatuacao->descricao}} /  
                                    @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <div class="col-lg-6">
                                    <i class="fa fa-envelope-o"></i> {{$profissional->email}}
                                </div>
                                <div class="col-lg-6">
                                    <i class="fa fa-phone"></i> {{$profissional->contato}} 
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-comment-o"></i> <strong>Descrição (escrito pelo autor):</strong><br>{{$profissional->descricao}} 
                                </div>
                            </li>
                            @if($profissional->site!="")
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-laptop"></i> <strong>Site:</strong><br> {{$profissional->site}}
                                </div>
                            </li>
                            @endif
                            <li class="list-group-item">
                                <div class="col-lg-12">
                                    <i class="fa fa-building-o"></i> <strong>Endereço:</strong><br> {{$profissional->endereco}} {{$profissional->numero}} {{$profissional->bairro}} {{$profissional->complemento}}
                                </div>
                            </li>
                            @if($profissional->pais!="" && $profissional->estado!="" && $profissional->cidade!="")
                            <li class="list-group-item">
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>País:</strong><br>{{$profissional->pais->descricao}}
                                </div>
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>Estado:</strong><br>{{$profissional->estado->descricao}}
                                </div>
                                <div class="col-lg-4">
                                    <i class="fa fa-map-marker"></i> <strong>Cidade:</strong><br>{{$profissional->cidade->descricao}}
                                </div>
                            </li>
                            @endif
                            @if($profissional->latitude!="")
                            <li class="list-group-item">
                                <div class="col-lg-12" style="height:400px" id="map"></div>
                            </li>
                            @endif
                            @if($profissional->facebook!="" || $profissional->twitter!="" || $profissional->instagram!="" || $profissional->linkedin!="")
                            <li class="list-group-item">
                                @if($profissional->facebook!="")
                                <div class="col-lg-3">
                                    <button type="button" class="btn social facebook" onclick="window.open('{{$profissional->facebook}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-facebook"></i>
                                        <span>Facebook</span>
                                    </button>
                                </div>
                                @endif
                                @if($profissional->twitter!="")
                                <div class="col-lg-3">
                                    <button type="button" class="btn social twitter" onclick="window.open('{{$profissional->twitter}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-twitter"></i>
                                        <span>Twitter</span>
                                    </button>
                                </div>
                                @endif
                                @if($profissional->instagram!="")
                                <div class="col-lg-3">
                                    <button type="button" class="btn social instagram" onclick="window.open('{{$profissional->instagram}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-instagram"></i>
                                        <span>Instagram</span>
                                    </button>
                                </div>
                                @endif
                                @if($profissional->linkedin!="")
                                <div class="col-lg-3">
                                    <button type="button" class="btn social linkedin" onclick="window.open('{{$profissional->linkedin}}','_blank')" style="padding-top: 0; padding-left:0; padding-bottom:0;">
                                        <i class="fa fa-linkedin"></i>
                                        <span>LinkedIn</span>
                                    </button>
                                </div>
                                @endif
                            </li>
                            @endif
                            <li class="list-group-item"> 
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="btn btn-warning" onclick="window.open('{{route('admin.profissionais.adminedit', [$usuario->id, $profissional->id])}}', '_self');">
                                        <i class="fa fa-pencil-square-o"></i> Editar informações do(a) profissional
                                    </button>
                                </div>
                            </li>
                        </ul>
                        @if($profissional->situacao_id==2)
                        <div class="card-footer">
                            {!! Form::model($profissional,['route' => ['admin.profissionais.analise'],'class' => 'form', 'method' => 'PUT', 'name' => 'form_parecer', 'id' => 'form_parecer']) !!}
                            {!! Form::hidden('id', $profissional->id) !!}
                            {!! Form::hidden('user_id', $profissional->user_id) !!}
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
                    </section>
                </aside>
            </div>
        </div>
    </div>
</div> <!-- .content -->
<script>
    function coloca_analise(pvalor){
        $("#analise").val(pvalor);
    }
</script>
@if($profissional->latitude!="")
<script>
    function initMap() {

        var myLatLng = {lat: {{$profissional->latitude}}, lng: {{$profissional->longitude}}};
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
