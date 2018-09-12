@extends('layouts.site')

@section('assets_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('public/slick/slick.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('public/slick/slick-theme.css') }}"/>
@endsection

@section('content')

@if(count($bannersprincipais)>0)
<header>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            @for ($i = 0; $i < count($bannersprincipais); $i++)
                <li data-target="#carouselExampleIndicators" data-slide-to="{{ $i }}" @if($i==0) class="active" @endif></li>
            @endfor
        </ol>
        <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            @php 
            $class1 = "carousel-item active";
            @endphp
            @foreach($bannersprincipais as $bannerprincipal)
            <div class="{{$class1}}" style="background-image: url('{{$bannerprincipal->imagem}}')" >
                @if($bannerprincipal->link!='')
                    <a href="{{url($bannerprincipal->link)}}" class="carousel-caption d-md-block banner-principal-texto-link" target="_blank">
                    </a>
                @endif

                <div class="carousel-caption d-md-block banner-principal-texto">
                    @if(isset($bannerprincipal->titulo))
                    <h3>{{$bannerprincipal->titulo}}</h3>
                    @endif
                    @if(isset($bannerprincipal->descricao))
                    <p>{{$bannerprincipal->descricao}}</p>
                    @endif
                </div>
            </div>
            @php 
            $class1 = 'carousel-item';
            @endphp
            @endforeach
        </div> 
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Próximo</span>
        </a>
    </div>
</header>
@endif
<!-- Page Content -->
<div class="container">
    <!--<div class="row mt-3">
        <div class="col-lg-4 mb-1">
            <a href="#"><img class="img-fluid" src="{{asset('public/images/400x100.png')}}" alt=""></a>
        </div>
        <div class="col-lg-4 mb-1">
            <a href="#"><img class="img-fluid" src="{{asset('public/images/400x100.png')}}" alt=""></a>
        </div>
        <div class="col-lg-4 mb-1">
            <a href="#"><img class="img-fluid" src="{{asset('public/images/400x100.png')}}" alt=""></a>
        </div>
    </div>-->
    <div class="row mt-2">
        <div class="col-lg-12">
            <h2 class="mb-3 text-custom-titulo">OloyFit:
                <small class="text-custom-desc">O mundo fitness num só lugar!</small>
            </h2>
            <hr>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-2 text-center">
                    <img class="img-fluid" src="{{asset('public/images/oloy.png')}}" alt="">
                </div>
                <div class="col-lg-10">
                    <a href="{{route('quemsomos')}}"><h5>Quem Somos</h5></a>
                    <p>Somos um Portal que ajuda pessoas que buscam um estilo de vida saudável a encontrar produtos e serviços fitness de alta performance na internet de forma rápida e fácil.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-2 text-center">
                    <img class="img-fluid" src="{{asset('public/images/prof.png')}}" alt="">
                </div>
                <div class="col-lg-10">
                    <a href="{{route('profissionais.posts',['atuacao'=>'todos'])}}"><h5>Profissionais de Alta Performance</h5></a>
                    <p>Aqui você encontra profissionais de alta performance que irão te levar para o próximo nível. Os top nutrólogos, nutricionistas, personais e coaches estão aqui.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-2 text-center">
                    <img class="img-fluid" src="{{asset('public/images/empresas.png')}}" alt="">
                </div>
                <div class="col-lg-10">
                    <a href="{{route('empresas.posts',['atuacao'=>'todos'])}}"><h5>Empresas Especializadas</h5></a>
                    <p>Saiba onde encontrar Empresas especializadas no mercado fitness com os melhores produtos e serviços disponíveis em sua região.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-2 text-center">
                    <img class="img-fluid" src="{{asset('public/images/eventos.png')}}" alt="">
                </div>
                <div class="col-lg-10">
                    <a href="{{route('eventos.posts',['categoria'=>'todos'])}}"><h5>Eventos</h5></a>
                    <p>Oferecemos uma área exclusiva de eventos fitness para que você não perca o foco e possa encontrar os principais eventos da sua região e compartilhar conhecimentos, habilidades, experiências e diversão.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-2 text-center">
                    <img class="img-fluid" src="{{asset('public/images/blog.png')}}" alt="">
                </div>
                <div class="col-lg-10">
                    <a href="{{route('blog.posts',['categoria'=>'todos'])}}"><h5>Blog</h5></a>
                    <p>Você encontrará aqui o melhor do conteúdo fitness na internet assinado por especialistas, com artigos, notícias e informações de tudo que você precisa para se manter bem informado e com alto rendimento.</p>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-2 text-center">
                    <img class="img-fluid" src="{{asset('public/images/infopro.png')}}" alt="">
                </div>
                    <div class="col-lg-10">
                    <a href="{{route('cursos.posts',['categoria'=>'todos'])}}"><h5>Top Produtos</h5></a>
                    <p>​Tenha acesso ao que há de melhor e mais avançado do mundo fitness sem sair de casa com os Produtos Digitais “Para Você”, “Para Profissionais” e “Para Empresas”, através dos maiores especialistas do país.​</p>
                </div>
            </div>
        </div>
    </div>

    @if(count($posts)>0)
    <div class="row mt-2">
        <div class="col-lg-12 mb-2">
            <h2 class="mb-3 text-custom-titulo">Conteúdos
                <small class="text-custom-desc">em destaque</small>
            </h2>
            <small class="pull-right"><a href="{{route('blog.posts',['categoria'=>'todos'])}}">Ver todos</a></small>
            <hr>
        </div>
        <div class="col-lg-12 carrossel-posts row" style="padding-right: 0px">
            @foreach($posts as $post)
                <div class="col-md-12 col-sm-6 ">
                    <div class="card h-100">
                        <a href="{{route('blog.post',['post'=>$post->slug])}}"><img class="card-img-top img-fluid" src="{{asset($post->imagem1)}}" alt=""></a>
                        <div class="card-body">
                            <h5 class="card-title text-center">
                                <a href="{{route('blog.post',['post'=>$post->slug])}}">{{$post->titulo}}</a>
                            </h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif


    @if(count($eventos)>0)
    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="mb-3 text-custom-titulo">Eventos
                <small class="text-custom-desc">em destaque</small>
            </h2>
            <small class="pull-right"><a href="{{route('eventos.posts',['categoria'=>'todos'])}}">Ver todos</a></small>
            <hr>
        </div>
        <div class="col-lg-12 carrossel-eventos row" style="padding-right: 0px">
            @foreach($eventos as $evento)
            <div class="col-md-12 ">
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
    </div>
    @endif
    
    @if(count($profissionais)>0)
    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="mb-3 text-custom-titulo">Profissionais
                <small class="text-custom-desc">parceiros</small>
            </h2>
            <small class="pull-right"><a href="{{route('profissionais.posts',['atuacao'=>'todos'])}}">Ver todos</a></small>
            <hr>
        </div>
        <div class="col-lg-12 carrossel-profissionais row" style="padding-right: 0px">
            @foreach($profissionais as $profissional)
            <div class="col-md-12 ">
                <div class="card h-100">
                    <a href="{{route('profissionais.post',['profissional'=>$profissional->slug])}}"><img class="card-img-top" src="{{asset($profissional->foto)}}" alt=""></a>
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="{{route('profissionais.post',['profissional'=>$profissional->slug])}}">{{$profissional->name}}</a>
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
    </div>
    @endif
    @if(count($empresas)>0)
    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="mb-3 text-custom-titulo">Empresas
                <small class="text-custom-desc">parceiras</small>
            </h2>
            <small class="pull-right"><a href="{{route('empresas.posts',['atuacao'=>'todos'])}}">Ver todos</a></small>
            <hr>
        </div>
        <div class="col-lg-12 carrossel-empresas row" style="padding-right: 0px">
            @foreach($empresas as $empresa)
            <div class="col-md-12 ">
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
    </div>
    @endif

    @if(count($cursos)>0)
    <div class="row">
        <div class="col-lg-12 mb-2">
            <h2 class="mb-3 text-custom-titulo">Top Produtos
                <small class="text-custom-desc">em destaque</small>
            </h2>
            <small class="pull-right"><a href="{{route('cursos.posts',['categoria'=>'todos'])}}">Ver todos</a></small>
            <hr>
        </div>
        <div class="col-lg-12 carrossel-cursos row" style="padding-right: 0px">
            @foreach($cursos as $curso)
            <div class="col-md-12 ">
                <div class="card h-100">
                    <a href="{{route('cursos.post',['curso'=>$curso->slug])}}"><img class="card-img-top" src="{{asset($curso->imagem1)}}" alt=""></a>
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            <a href="{{route('cursos.post',['curso'=>$curso->slug])}}">{{$curso->titulo}}</a>
                        </h5>
                        @if($curso->sub_titulo!="")
                        <p class="card-text text-center"><small>{{$curso->sub_titulo}}</small></p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
<!-- /.container -->

@endsection

@section('assets_scripts')
<script type="text/javascript" src="{{ asset('public/slick/slick.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.carrossel-posts').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            infinite: true,
            speed: 300,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true
                    
                }
                },
                {
                breakpoint: 480,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.carrossel-eventos').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            infinite: true,
            speed: 400,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true
                }
                },
                {
                breakpoint: 480,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.carrossel-profissionais').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: true,
            speed: 500,
            slidesToShow: 5,
            slidesToScroll: 5, 
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 5000,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 5000,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true
                }
                },
                {
                breakpoint: 480,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 5000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.carrossel-empresas').slick({
            autoplay: true,
            autoplaySpeed: 5000,
            infinite: true,
            speed: 500,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 5000,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 5000,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true
                }
                },
                {
                breakpoint: 480,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 5000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

        $('.carrossel-cursos').slick({
            autoplay: true,
            autoplaySpeed: 3000,
            infinite: true,
            speed: 400,
            slidesToShow: 4,
            slidesToScroll: 4,
            responsive: [
                {
                breakpoint: 1024,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 3,
                    slidesToScroll: 3,
                    infinite: true
                }
                },
                {
                breakpoint: 600,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 2,
                    slidesToScroll: 2,
                    infinite: true
                }
                },
                {
                breakpoint: 480,
                settings: {
                    autoplay: true,
                    autoplaySpeed: 3000,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true
                }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });
    });
  </script>
@endsection