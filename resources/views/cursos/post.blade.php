@extends('layouts.site')

@section('assets_meta')
    <meta property='og:title' content='{{$curso->titulo}}' />
    <meta property='og:description' content='{{$curso->descricao}}' />
    <meta property='og:image' itemprop="image" content='{{ asset($curso->imagem1) }}' />
    <meta property='og:type' content='website' />
    <meta property='article:author' content='https://www.facebook.com/oloyfit' />
    <meta property='og:site_name' content='OloyFit' />
    <meta name='twitter:card' content='summary_large_image' />
    <meta name='twitter:title' content='{{$curso->titulo}}' />
    <meta name='twitter:description' content='{{$curso->descricao}}' />
    <meta name='twitter:image:src' content='{{ asset($curso->imagem1) }}' />
@endsection

@section('titulo')
    {{$curso->titulo}}
@endsection

@section('descricao')
    InfoProduto OloyFit: {{$curso->titulo}}
@endsection

@section('content')

<div class="container">
    <br>
    <!-- Intro Content -->
    <div class="row mb-2">
        <div class="col-lg-12 text-custom-titulo"><h3>{{$curso->titulo}}</h3><hr></div>
        <div class="row col-lg-8" style="margin-left: 0px">
            @if($curso->imagem2!="")
            <div class="col-lg-12">
                <img class="img-fluid rounded mb-4" src="{{ asset($curso->imagem2) }}" alt="">
            </div>
            @endif
            <div class="col-lg-12 text-justify">
                <p>{!!$curso->descricao!!}</p>
            </div>
            @if($curso->data_inicio!="" && $curso->data_fim!="")
            <div class="col-lg-6">
                <i class="fa fa-calendar"></i> <strong>Inicio:</strong> {{$curso->data_inicio}} 
            </div>
            <div class="col-lg-6">
                <i class="fa fa-calendar"></i> <strong>Fim:</strong> {{$curso->data_fim}} 
            </div>
            @endif
            @if($curso->contato!="")
            <div class="col-lg-6">
                <i class="fa fa-phone"></i> <strong>Contato:</strong> {{$curso->contato}} 
            </div>
            @endif
            <div class="col-lg-6">
                <i class="fa fa-money"></i> <strong>Investimento:</strong> @if($curso->investimento!=""){{$curso->investimento}} @else Não informado @endif
            </div>
            @if($curso->site!="")
                <div class="col-lg-12">
                    <i class="fa fa-laptop"></i> <strong>Site:</strong> <a href="{{$curso->site}}" target="_blank">Acesse aqui</a>
                </div>
            @endif
            @if($curso->facebook!="")
            <div class="col-lg-12">
                <i class="fa fa-facebook-square"></i> <strong>Facebook:</strong> <a href="{{$curso->facebook}}" target="_blank">Curta a página</a>
            </div>
            @endif
            @if($curso->twitter!="")
            <div class="col-lg-12">
                <i class="fa fa-twitter"></i> <strong>Twitter:</strong> <a href="{{$curso->twitter}}" target="_blank">Siga-nos</a>
            </div>
            @endif
            @if($curso->instagram!="")
            <div class="col-lg-12">
                <i class="fa fa-instagram"></i> <strong>Instagram:</strong> <a href="{{$curso->instagram}}" target="_blank">Siga-nos</a>
            </div>
            @endif
            @if($curso->endereco!="")
            <div class="col-lg-12">
                <i class="fa fa-building-o"></i> <strong>Endereço:</strong> {{$curso->endereco}} {{$curso->numero}} {{$curso->bairro}} {{$curso->complemento}} 
                @if($curso->pais!="" && $curso->estado!="" && $curso->cidade!=""), {{$curso->cidade->descricao}}, {{$curso->estado->descricao}}, {{$curso->pais->descricao}} @endif
            </div>
            @endif
            @if($curso->link!="")
            <div class="col-lg-12 text-center">
                <hr>
                <button type="buttom" onclick="window.open('{{$curso->link}}','_blank')" class="btn btn-custom">Comece agora</button>
                <hr>
            </div>
            @endif
            <div id="share" class="col-lg-12 mb-3"></div>
        </div>
        <div class="col-lg-4">
            <div class="container row mb-5">
                <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Top Produtos</h5>
                    <hr>
                </div>
                <div class="col-md-12"><a href="{{route('cursos.vcposts',['categoria'=>'todos'])}}">Para Você</a></div>
                <div class="col-md-12"><a href="{{route('cursos.profposts',['categoria'=>'todos'])}}">Para Profissionais</a></div>
                <div class="col-md-12"><a href="{{route('cursos.empposts',['categoria'=>'todos'])}}">Para Empresas</a></div>
            </div>
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
                        <a href="{{route('profissionais.subposts',['atuacao'=>$patuacao->slug,'subatuacao'=>'todos'])}}">
                            {{$patuacao->descricao}}
                        </a>
                    </div>
                    @else
                        <div class="col-md-12">
                            <a  href="{{route('profissionais.posts',['atuacao'=>$patuacao->slug])}}">
                                {{$patuacao->descricao}}
                            </a>
                        </div>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            @if(count($cursos)>0)
            <hr>
            <!-- Our Customers -->
            <h3 class="text-custom-titulo">Outros cursos</h3>
            <div class="row">
                @foreach($cursos as $curso)
                <div class="col-lg-4 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="{{route('cursos.post',['curso'=>$curso->slug])}}"><img class="card-img-top" src="{{asset($curso->imagem1)}}" alt=""></a>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="{{route('cursos.post',['curso'=>$curso->slug])}}">{{$curso->titulo}}</a>
                            </h4>
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

@section('assets_scripts')
<script>
    $("#share").jsSocials({
        shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "whatsapp"]
    });
</script>

@endsection