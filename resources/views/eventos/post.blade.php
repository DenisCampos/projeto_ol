@extends('layouts.site')

@section('assets_meta')
    <meta property='og:title' content='{{$evento->titulo}}' />
    <meta property='og:description' content='{{$evento->descricao}}' />
    <meta property='og:image' itemprop="image" content='{{ asset($evento->imagem1) }}' />
    <meta property='og:type' content='website' />
    <meta property='article:author' content='https://www.facebook.com/oloyfit' />
    <meta property='og:site_name' content='OloyFit' />
    <meta name='twitter:card' content='summary_large_image' />
    <meta name='twitter:title' content='{{$evento->titulo}}' />
    <meta name='twitter:description' content='{{$evento->descricao}}' />
    <meta name='twitter:image:src' content='{{ asset($evento->imagem1) }}' />
@endsection

@section('titulo')
    {{$evento->titulo}}
@endsection

@section('descricao')
    Evento OloyFit: {{$evento->titulo}}
@endsection

@section('content')

<div class="container">
    <br>
    <!-- Intro Content -->
    <div class="row mb-2">
        <div class="col-lg-12 text-custom-titulo"><h3>{{$evento->titulo}}</h3><hr></div>
        <div class="row col-lg-8" style="margin-left: 0px">
            @if($evento->imagem2!="")
            <div class="col-lg-12">
                <img class="img-fluid rounded mb-2" src="{{ asset($evento->imagem2) }}" data-src="{{ asset($evento->imagem2) }}" alt="{{$evento->titulo}}">
            </div>
            @endif
            <div class="col-lg-12">
                <p>{{$evento->descricao}}</p>
            </div>
            <div class="col-lg-6">
                <i class="fa fa-calendar"></i> <strong>Inicio:</strong> {{$evento->data_inicio}} 
            </div>
            <div class="col-lg-6">
                <i class="fa fa-calendar"></i> <strong>Fim:</strong> {{$evento->data_fim}} 
            </div>
            <div class="col-lg-6">
                <i class="fa fa-phone"></i> <strong>Contato:</strong> {{$evento->contato}} 
            </div>
            <div class="col-lg-6">
                <i class="fa fa-money"></i> <strong>Investimento:</strong> @if($evento->investimento!=""){{$evento->investimento}} @else Não informado @endif
            </div>
            @if($evento->site!="")
                <div class="col-lg-12">
                    <i class="fa fa-laptop"></i> <strong>Site:</strong> <a href="{{$evento->site}}" target="_blank">Acesse o site</a>
                </div>
            @endif
            @if($evento->facebook!="")
            <div class="col-lg-12">
                <i class="fa fa-facebook-square"></i> <strong>Facebook:</strong> <a href="{{$evento->facebook}}" target="_blank">Curta a página</a>
            </div>
            @endif
            @if($evento->twitter!="")
            <div class="col-lg-12">
                <i class="fa fa-twitter"></i> <strong>Twitter:</strong> <a href="{{$evento->twitter}}" target="_blank">Acesse e siga</a>
            </div>
            @endif
            @if($evento->instagram!="")
            <div class="col-lg-12">
                <i class="fa fa-instagram"></i> <strong>Instagram:</strong> <a href="{{$evento->instagram}}" target="_blank">Acesse e siga</a>
            </div>
            @endif
            <div class="col-lg-12">
                <i class="fa fa-building-o"></i> <strong>Endereço:</strong> {{$evento->endereco}} {{$evento->numero}} {{$evento->bairro}} {{$evento->complemento}}
                @if($evento->pais!="" && $evento->estado!="" && $evento->cidade!="")
                    , {{$evento->cidade->descricao}}, {{$evento->estado->descricao}}, {{$evento->pais->descricao}} 
                @endif
            </div>  
            @if($evento->latitude!="")
            <div class="col-lg-12 mb-3 mt-2" style="height:250px" id="map"></div>
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
            <div id="share" class="col-lg-12 mb-3"></div>
        </div>
        <div class="col-lg-4">
            <div class="container row mb-5">
                <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Top Produtos 
                        <button type="buttom" onclick="window.open('{{route('cursos.posts',['categoria'=>'todos'])}}','_self')" class="btn btn-sm btn-custom pull-right">Todos</button>
                    </h5>
                    <hr>
                </div>
                @foreach($cursos as $curso)
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3">
                        <a href="{{route('cursos.post',['post'=>$curso->slug])}}">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="{{asset($curso->imagem1)}}" alt="">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h5 class="text-custom-titulo">{{$curso->titulo}}</h5>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="container row">
                <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Eventos</h5>
                    <hr>
                </div>
                @foreach($vcategorias as $vcategoria)
                    <div class="col-md-12"><a href="{{route('eventos.posts',['categoria'=>$vcategoria->slug])}}">{{$vcategoria->descricao}}</a></div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-12">
        @if(count($eventos)>0)
        <hr>
        <!-- Our Customers -->
        <h3 class="text-custom-titulo">Outros eventos</h3>
        <div class="row">
            @foreach($eventos as $evento)
            <div class="col-lg-3 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <a href="{{route('eventos.post',['evento'=>$evento->slug])}}"><img class="card-img-top" src="{{asset($evento->imagem1)}}" alt=""></a>
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="{{route('eventos.post',['evento'=>$evento->slug])}}">{{$evento->titulo}}</a>
                        </h5>
                        <p class="card-text text-center"><small>
                            Data: {{$evento->getData($evento->data_inicio) }}<br>
                            @if($evento->cidade_id!="" && $evento->estado_id!="")
                            Local: {{$evento->cidade->descricao}} -  {{$evento->estado->sigla}}
                            @endif
                        </small></p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        </div>
        <!-- /.row -->
    </div>
    <!-- /.row -->
</div>

@endsection
@section('assets_scripts')
<script>
    $("#share").jsSocials({
        shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "whatsapp"]
    });
</script>

@endsection
