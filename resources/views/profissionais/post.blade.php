@extends('layouts.site')

@section('content')

<div class="container">
    <br>
    <!-- Intro Content -->
    <div class="row mb-2">
        <div class="row col-lg-8" style="margin-left: 0px">
            @if($profissional->foto!="")
            <div class="col-lg-6">
                <img class="img-fluid rounded mb-4" src="{{ asset($profissional->foto) }}" alt="">
            </div>
            <div class="col-lg-6 text-justify">
                <h3 class="text-custom-titulo">{{$profissional->name}}</h3>
                <p>
                    <small>
                    @php
                        $cont = 0;
                    @endphp
                    @foreach($profatuacoes as $profatuacao)
                        @if($cont == 0)
                            {{$profatuacao->descricao}}
                        @else
                            / {{$profatuacao->descricao}}
                        @endif    

                    @php
                        $cont++;
                    @endphp
                    @endforeach 
                    </small>
                </p>
                <p>{{$profissional->descricao}}</p>
            </div>
            @else
            <div class="col-lg-12 text-justify">
                <h3 class="text-custom-titulo">{{$profissional->name}}</h3>
                <p>{{$profissional->descricao}}</p>
            </div>
            @endif
            <div class="col-lg-6 mb-4">
                <div class="row">
                    <div class="col-lg-12">
                        <i class="fa fa-envelope-o"></i> <strong>E-mail:</strong> {{$profissional->email}}
                    </div>
                    <div class="col-lg-12">
                        <i class="fa fa-phone"></i> <strong>Contato:</strong> {{$profissional->contato}}
                    </div>
                    @if($profissional->site!="")
                        <div class="col-lg-12">
                            <i class="fa fa-laptop"></i> <strong>Site:</strong> <a href="{{ $profissional->site}}" target="_blank">Acesse aqui</a>
                        </div>
                    @endif
                    @if($profissional->facebook!="")
                    <div class="col-lg-12">
                        <i class="fa fa-facebook-square"></i> <strong>Facebook:</strong> <a href="{{$profissional->facebook}}" target="_blank">Curta a página</a>
                    </div>
                    @endif
                    @if($profissional->twitter!="")
                    <div class="col-lg-12">
                        <i class="fa fa-twitter"></i> <strong>Twitter:</strong> <a href="{{$profissional->twitter}}" target="_blank">Acesse e siga</a>
                    </div>
                    @endif
                    @if($profissional->instagram!="")
                    <div class="col-lg-12">
                        <i class="fa fa-instagram"></i> <strong>Instagram:</strong> <a href="{{$profissional->instagram}}" target="_blank">Acesse e siga</a>
                    </div>
                    @endif
                    @if($profissional->linkedin!="")
                    <div class="col-lg-12">
                            <i class="fa fa-linkedin-square"></i> <strong>LinkedIn:</strong> <a href="{{$profissional->linkedin}}" target="_blank">Acesse e siga</a>
                        </button>
                    </div>
                    @endif
                    <div class="col-lg-12">
                        <i class="fa fa-building-o"></i> <strong>Endereço:</strong> {{$profissional->endereco}} {{$profissional->numero}} {{$profissional->bairro}} {{$profissional->complemento}}
                        @if($profissional->pais!="" && $profissional->estado!="" && $profissional->cidade!=""), {{$profissional->cidade->descricao}}, {{$profissional->estado->descricao}}, {{$profissional->pais->descricao}} @endif
                    </div>
                </div>
            </div>
            @if($profissional->latitude!="")
            <div class="col-lg-6 mb-4 text-center" style="height:250px" id="map"></div>
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
            <div class="col-lg-12">
                <div class="row">
                    @if($profissional->banner==1)
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
        <div class="col-lg-4">
            <div class="container row">
                <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Profissionais</h5>
                    <hr>
                </div>
                @foreach($patuacoes as $patuacao)
                    @php
                    $possui=false;
                    @endphp
                    @foreach($psubatuacoes as $psubatuacao)
                        @php
                        if($patuacao->id==$psubatuacao->atuacao_id){
                            $possui=true;
                            break;
                        }
                        @endphp
                    @endforeach
                    @if($possui==true)
                    <div class="col-md-12">
                        <a href="{{route('profissionais.subposts',['atuacao'=>$patuacao->id,'subatuacao'=>0])}}">
                            {{$patuacao->descricao}}
                        </a>
                    </div>
                    @else
                        <div class="col-md-12">
                            <a  href="{{route('profissionais.posts',['atuacao'=>$patuacao->id])}}">
                                {{$patuacao->descricao}}
                            </a>
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-12">
        @if(count($profissionais)>0)
        <hr>
        <!-- Our Customers -->
        <h3 class="text-custom-titulo">Outros profissionais</h3>
        <div class="row">
            @foreach($profissionais as $profissional)
            <div class="col-lg-3 col-sm-6 portfolio-item">
                <div class="card h-100">
                    <a href="{{route('profissionais.post',['profissional'=>$profissional->id])}}"><img class="card-img-top" src="{{asset($profissional->foto)}}" alt=""></a>
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="{{route('profissionais.post',['profissional'=>$profissional->id])}}">{{$profissional->name}}</a>
                        </h5>
                        <p class="text-center"><small>
                            @foreach($profatuacoes_array as $profatuacoes)
                                @if($profatuacoes[0]->profissional_id == $profissional->id)
                                    @php
                                        $cont = 0;
                                    @endphp
                                    @foreach($profatuacoes as $profatuacao)
                                        @if($cont==0)
                                            {{$profatuacao->descricao}}
                                            @php
                                                $cont++;
                                            @endphp
                                        @else
                                            / {{$profatuacao->descricao}}
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
        <!-- /.row -->
        @endif
        </div>
    </div>
    <!-- /.row -->
</div>
@endsection