@extends('layouts.site')

@section('assets_meta')
    <meta property='og:title' content='{{$empresa->name}}' />
    <meta property='og:description' content='{{$empresa->descricao}}' />
    <meta property='og:image' itemprop="image" content='{{ asset($empresa->imagem1) }}' />
    <meta property='og:type' content='website' />
    <meta property='article:author' content='https://www.facebook.com/oloyfit' />
    <meta property='og:site_name' content='OloyFit' />
    <meta name='twitter:card' content='summary_large_image' />
    <meta name='twitter:title' content='{{$empresa->name}}' />
    <meta name='twitter:description' content='{{$empresa->descricao}}' />
    <meta name='twitter:image:src' content='{{ asset($empresa->imagem1) }}' />
@endsection

@section('titulo')
    {{$empresa->name}}
@endsection

@section('descricao')
    Parceiro OloyFit: {{$empresa->name}}
@endsection

@section('content')

<div class="container">
    <br>
    <!-- Intro Content -->
    <div class="row mb-2">
        <div class="col-lg-12 text-custom-titulo"><h3>{{$empresa->name}}</h3><hr></div>
        <div class="row col-lg-8" style="margin-left: 0px">
            @if($empresa->imagem2!="" || $empresa->imagem3!="")
            <div class="col-lg-12 mb-2">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        @if($empresa->imagem2!="")
                        <div class="carousel-item active" style="height: auto; min-height:171px">
                        <img class="d-block w-100" src="{{ asset($empresa->imagem2) }}" alt="First slide">
                        </div>
                        @endif
                        @if($empresa->imagem3!="")
                        <div class="carousel-item" @if($empresa->imagem2=='') active @endif style="height: auto; min-height:171px">
                        <img class="d-block w-100" src="{{ asset($empresa->imagem3) }}" alt="Second slide">
                        </div>
                        @endif
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Próximo</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Anterior</span>
                    </a>
                </div>
            </div>     
            @endif
            <div class="col-lg-12 text-justify">
                <p>{{$empresa->descricao}}</p>
            </div>
            <div class="col-lg-12 mb-4">
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        @if($empresa->site!="")
                        <div class="col-lg-12">
                            <i class="fa fa-laptop"></i> <strong>Site:</strong> <a href="{{$empresa->site}}" target="_blank">Acesse aqui</a>
                        </div>
                        @endif
                        @if($empresa->facebook!="")
                        <div class="col-lg-12">
                            <i class="fa fa-facebook-square"></i> <strong>Facebook:</strong> <a href="{{$empresa->facebook}}" target="_blank">Curta a página</a>
                        </div>
                        @endif
                        @if($empresa->twitter!="")
                        <div class="col-lg-12">
                            <i class="fa fa-twitter"></i> <strong>Twitter:</strong> <a href="{{$empresa->twitter}}" target="_blank">Acesse e siga</a>
                        </div>
                        @endif
                        @if($empresa->instagram!="")
                        <div class="col-lg-12">
                            <i class="fa fa-instagram"></i> <strong>Instagram:</strong> <a href="{{$empresa->instagram}}" target="_blank">Acesse e siga</a>
                        </div>
                        @endif
                        <div class="col-lg-12">
                            <i class="fa fa-building-o"></i> <strong>Endereço:</strong> {{$empresa->endereco}} {{$empresa->numero}} {{$empresa->bairro}} {{$empresa->complemento}}
                            @if($empresa->pais!="" && $empresa->estado!="" && $empresa->cidade!=""), {{$empresa->cidade->descricao}}, {{$empresa->estado->descricao}}, {{$empresa->pais->descricao}} @endif
                        </div>
                    </div>
                    @if($empresa->latitude!="")
                    <div class="col-lg-6  mb-4" style="height:300px" id="map"></div>
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
                    <div class="col-lg-12">
                        <div class="row">
                            @if($empresa->banner==1)
                                @foreach($banners as $banner)
                                    <div class="col-lg-6 mb-3">
                                        <a href="{{$banner->site}}" target="_blank">
                                            <img class="img-fluid rounded" src="{{ asset($banner->banner) }}" alt="">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div id="share" class="col-lg-12 mb-3"></div>
        </div>
        <div class="col-lg-4">
            <div class="container row">
                <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Empresas</h5>
                    <hr>
                </div>
                @foreach($eatuacoes as $eatuacao)
                    @php
                    $possui=false;
                    @endphp
                    @foreach($esubatuacoes as $esubatuacao)
                        @php
                        if($eatuacao->id==$esubatuacao->atuacao_id){
                            $possui=true;
                            break;
                        }
                        @endphp
                    @endforeach
                    @if($possui==true)
                    <div class="col-md-12">
                        <a href="{{route('empresas.subposts',['atuacao'=>$eatuacao->slug,'subatuacao'=>'todos'])}}">
                            {{$eatuacao->descricao}}
                        </a>
                    </div>
                    @else
                        <div class="col-md-12">
                            <a  href="{{route('empresas.posts',['atuacao'=>$eatuacao->slug])}}">
                                {{$eatuacao->descricao}}
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-lg-12">
            @if(count($empresas)>0)
            <hr> 
            <!-- Our Customers -->
            <h3 class="text-custom-titulo">Outros empresas</h3>
            <div class="row">
                @foreach($empresas as $empresa)
                <div class="col-lg-3 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="{{route('empresas.post',['empresa'=>$empresa->slug])}}"><img class="card-img-top" src="{{asset($empresa->imagem1)}}" alt=""></a>
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <a href="{{route('empresas.post',['empresa'=>$empresa->slug])}}">{{$empresa->name}}</a>
                            </h5>
                            <p class="text-center"><small>
                                @foreach($empatuacoes_array as $empatuacoes)
                                    @if($empatuacoes[0]->empresa_id == $empresa->id)
                                        @php
                                            $cont = 0;
                                        @endphp
                                        @foreach($empatuacoes as $empatuacao)
                                            @if($cont==0)
                                                {{$empatuacao->descricao}}
                                                @php
                                                    $cont++;
                                                @endphp
                                            @else
                                                / {{$empatuacao->descricao}}
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </small></p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        </div>
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