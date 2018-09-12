<!DOCTYPE html>
<html class="no-js" lang="{{ app()->getLocale() }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123943601-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-123943601-1');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('descricao', 'OloyFit, conectando pessoas que buscam um estilo de vida saudável.')"> 
    <meta name="keywords" content="OloyFit, oloyfit, vida saudavel, bem estar, suplementos" >
    <meta name="keywords" content="alimentacao saudavel, nutricionistas, nutrólogos, personal trainer" >
    <meta name="author" content="OloyFit">
    <meta name="robot" content="all" >
    <meta name="googlebot" content="all">
    <meta name="google-site-verification" content="iMnIjKg586mnbtTv_Tx4EFLcyFkmoSDPEZ4nHcV3GRM" />
    @yield('assets_meta')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('titulo', config('app.subtitle', 'Laravel'))  </title>

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="{{ asset('public/images/oloyfitico.ico') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/css/normalize.css') }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('public/vendor/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('public/css/modern-business.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/bootstrap-4-navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/scss/socials.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/jssocials.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/jssocials-theme-flat.css') }}">
    @yield('assets_css')
</head>
<body style="padding-top: 30px">
    <div class="container fixed-top" style="position: relative">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-3">
                <a style="margin-top:0px;" href="{{route('index')}}"><img src="{{ asset('public/images/cropped-oloyfit-logo.png') }}" alt="Logo" class="img-fluid"></a>
            </div>
            <div class="col-lg-2 text-center mb-2">
                <a href="https://www.facebook.com/oloyfit"><img class="img-fluid" src="{{asset('public/images/face-oloy.png')}}" alt=""></a>
                <!--<a href="#"><img class="img-fluid" src="{{asset('public/images/oloytube.png')}}" alt=""></a>-->
                <a href="https://www.instagram.com/oloyfit/"><img class="img-fluid" src="{{asset('public/images/oloygram.png')}}" alt=""></a>
                <a href="https://www.instagram.com/oloyfit/"><img class="img-fluid" src="{{asset('public/images/iGTV-ICONsocial - oloyfit_.png')}}" alt=""></a>
                <a href="https://api.whatsapp.com/send?phone=5598983103977&text=Seja%20bem%20vindo%20ao%20WhastApp%20OloyFit!%20Somos%20um%20Portal%20que%20conecta%20pessoas%20que%20buscam%20um%20estilo%20de%20vida%20saud%C3%A1vel%20aos%20profissionais%20e%20empresas%20do%20segmento%20fitness,%20oferecendo%20conte%C3%BAdos%20de%20valor%20e%20informa%C3%A7%C3%B5es%20de%20produtos%20e%20servi%C3%A7os%20de%20alta%20%20performance%20que%20ir%C3%A3o%20potencializar%20seus%20resultados.%20J%C3%A1%20se%20cadastrou%20em%20nosso%20Portal?%20N%C3%A3o%20perca%20tempo%20e%20fique%20por%20dentro%20de%20tudo%20que%20voc%C3%AA%20precisa%20saber%20do%20mundo%20fitness%20pertinho%20de%20voc%C3%AA!%20Equipe%20OloyFit.%0D%0A%E2%80%8B
                "><img class="img-fluid" src="{{asset('public/images/insta_icons social - oloyfit_.png')}}" alt=""></a>
            </div>
            <div class="container col-lg-5 mb-2 text-center">
                <div>
                @guest
                    <form class="form-inline justify-content-center" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-0 offset-md-3 justify-content-center align-items-center">
                            <input id="email" type="email" class="form-control mb-1 form-control-sm {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                          
                            <input id="password" type="password" class="form-control mb-1 form-control-sm {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Senha">

                            <button type="submit" class="btn btn-sm btn-custom">Entrar</button>
                        </div>
                        <div class="form-group mb-0 offset-md-3">
                            @if ($errors->has('password'))
                                <small class="invalid-feedback" style="display: block">
                                    <strong>{{ $errors->first('password') }}</strong><br>
                                </small>
                            @endif
                            @if ($errors->has('email'))
                                <small class="invalid-feedback" style="display: block">
                                    <strong>{{ $errors->first('email') }}</strong><br>
                                </small>
                            @endif
                        </div>
                    </form>
                    <small>
                        <a href="{{ route('password.request') }}">Esqueci a Senha</a> / <a href="{{ route('register') }}"> Cadastre-se aqui</a>
                    </small>
                @else
                    <div class="form-group mb-2 text-center col-12">
                        <a href="{{ route('home') }}">

                        @if(Auth::user()->foto=="")
                            <img class="rounded-circle " style="width:32px; height:32px;"  src="{{ asset('public/images/oloyfit-logo3.png') }}" alt="User Avatar">
                        @else
                            <img class="rounded-circle" style="width:32px; height:32px;" src="{{ asset(Auth::user()->foto) }}" alt="User Avatar">
                        @endif
                        {{ Auth::user()->name }} 
                        </a>

                    </div>
                    <div class="form-group mb-2 text-center col-12">
                    </div>
                @endguest
                </div>
            </div>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom p-1"> 
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('index') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profissionaismenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profissionais
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profissionaismenu">
                            <div><a class="dropdown-item" href="{{route('profissionais.posts',['atuacao'=>'todos'])}}">Todos</a></div>
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
                                <div>
                                    <a class="dropdown-item submenu" href="#">
                                        {{$patuacao->descricao}}<i class="fa fa-caret-right float-right mt-1"></i> &nbsp;
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($psubatuacoes as $psubatuacao)
                                        @if($patuacao->id==$psubatuacao->atuacao_id)
                                        <li><a class="dropdown-item" href="{{route('profissionais.subposts',['atuacao'=>$patuacao->slug,'subatuacao'=>$psubatuacao->slug])}}">{{$psubatuacao->descricao}}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div><a class="dropdown-item" href="{{route('profissionais.posts',['atuacao'=>$patuacao->slug])}}">{{$patuacao->descricao}}</a></div>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="empresassmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Empresas
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="empresassmenu">
                            <div><a class="dropdown-item" href="{{route('empresas.posts',['atuacao'=>'todos'])}}">Todos</a></div>
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
                                <div>
                                    <a class="dropdown-item submenu " href="#">
                                        {{$eatuacao->descricao}}<i class="fa fa-caret-right float-right mt-1"></i> &nbsp;
                                    </a>
                                    <ul class="dropdown-menu">
                                        @foreach($esubatuacoes as $esubatuacao)
                                        @if($eatuacao->id==$esubatuacao->atuacao_id)
                                        <li><a class="dropdown-item" href="{{route('empresas.subposts',['atuacao'=>$eatuacao->slug,'subatuacao'=>$esubatuacao->slug])}}">{{$esubatuacao->descricao}}</a></li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>
                                @else
                                <div><a class="dropdown-item" href="{{route('empresas.posts',['atuacao'=>$eatuacao->slug])}}">{{$eatuacao->descricao}}</a></div>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="eventosmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Eventos
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="eventosmenu">
                            <div><a class="dropdown-item" href="{{route('eventos.posts',['categoria'=>'todos'])}}">Todos</a></div>
                            @foreach($vcategorias as $vcategoria)
                                <div><a class="dropdown-item" href="{{route('eventos.posts',['categoria'=>$vcategoria->slug])}}">{{$vcategoria->descricao}}</a></div>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="produtosmenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Top Produtos
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="produtosmenu">
                            <div><a class="dropdown-item" href="{{route('cursos.vcposts',['categoria'=>'todos'])}}">Para Você</a></div>
                            <div><a class="dropdown-item" href="{{route('cursos.profposts',['categoria'=>'todos'])}}">Para Profissionais</a></div>
                            <div><a class="dropdown-item" href="{{route('cursos.empposts',['categoria'=>'todos'])}}">Para Empresas</a></div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('blog.posts',['categoria'=>'todos'])}}">Blog OloyFit</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faleconosco') }}">Fale Conosco</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
     <!-- Footer -->
    <footer class="py-4 bg-custom">
        <div class="container" >
            <div class="row">
                <div class="col-lg-3 mb-2">
                        <strong style=" color: #e1e7f3;">Sobre:</a></strong><br>
                        <a href="{{route('quemsomos')}}"  style=" color: #e1e7f3;">Quem somos</a><br>
                        <a href="{{route('quemsomos')}}"  style=" color: #e1e7f3;">Missão</a><br>
                        <a href="{{route('quemsomos')}}"  style=" color: #e1e7f3;">Visão</a><br>
                        <a href="{{route('quemsomos')}}"  style=" color: #e1e7f3;">Valores</a>
                </div>
                <div class="col-lg-3 mb-2">
                        <strong style=" color: #e1e7f3;">Aqui você encontra:</a></strong><br>
                        <a href="{{route('profissionais.posts',['atuacao'=>'todos'])}}"  style=" color: #e1e7f3;">Profissionais</a><br>
                        <a href="{{route('empresas.posts',['atuacao'=>'todos'])}}"  style=" color: #e1e7f3;">Empresas</a><br>
                        <a href="{{route('eventos.posts',['categoria'=>'todos'])}}"  style=" color: #e1e7f3;">Eventos</a><br>
                        <a href="{{route('blog.posts',['categoria'=>'todos'])}}"  style=" color: #e1e7f3;">Blog</a><br>
                        <a href="{{route('cursos.posts',['categoria'=>'todos'])}}"  style=" color: #e1e7f3;">Top Produtos</a>
                </div>
                <div class="col-lg-3 mb-2">
                        <strong style=" color: #e1e7f3;">Contatos:</a></strong><br>
                        <font style=" color: #e1e7f3;">contato@oloyfit.com</font><br>
                        <a href="https://www.facebook.com/oloyfit"><img class="img-fluid" src="{{asset('public/images/face-oloy.png')}}" alt=""></a> <a href="https://www.instagram.com/oloyfit/"><img class="img-fluid" src="{{asset('public/images/oloygram.png')}}" alt=""></a> <a href="https://www.instagram.com/oloyfit/"><img class="img-fluid" src="{{asset('public/images/iGTV-ICONsocial - oloyfit_.png')}}" alt=""></a>
                        <a href="https://api.whatsapp.com/send?phone=5598983103977&text=Seja%20bem%20vindo%20ao%20WhastApp%20OloyFit!%20Somos%20um%20Portal%20que%20conecta%20pessoas%20que%20buscam%20um%20estilo%20de%20vida%20saud%C3%A1vel%20aos%20profissionais%20e%20empresas%20do%20segmento%20fitness,%20oferecendo%20conte%C3%BAdos%20de%20valor%20e%20informa%C3%A7%C3%B5es%20de%20produtos%20e%20servi%C3%A7os%20de%20alta%20%20performance%20que%20ir%C3%A3o%20potencializar%20seus%20resultados.%20J%C3%A1%20se%20cadastrou%20em%20nosso%20Portal?%20N%C3%A3o%20perca%20tempo%20e%20fique%20por%20dentro%20de%20tudo%20que%20voc%C3%AA%20precisa%20saber%20do%20mundo%20fitness%20pertinho%20de%20voc%C3%AA!%20Equipe%20OloyFit.%0D%0A%E2%80%8B">
                        <img class="img-fluid" src="{{asset('public/images/insta_icons social - oloyfit_.png')}}" alt=""></a>
                </div>
                <div class="col-lg-3 mb-2">
                    <a href="https://abstartups.com.br/">
                        <img class="img-fluid" src="{{asset('public/images/logo-header-rebranding.png')}}" alt="">
                    </a>
                </div>
                <div class="col-lg-12">
                    <hr>
                </div>
                <div class="col-lg-12 offset-md-4">
                    <a href="{{route('termosprivacidade')}}"  style=" color: #e1e7f3;">Termos de uso e privacidade</a>
                </div>
            </div>
        </div>
       
    </footer>
    <div class="container fixed-bottom text-center" style="position: relative">
        <p><small>&copy; 2018 Copyright OloyFit. Todos os direitos reservados. Desenvolvido <a href="https://dmrcsistemas.com.br/site/">DMRC</a> e <a href="http://www.mjrdesign.com.br/">MJRDESIGN</a>.</p></small>
    </div>

     <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('public/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap-4-navbar.js') }}"></script>
    <script src="{{ asset('public/js/jssocials.min.js') }}"></script>
    @yield('assets_scripts')
</body>
</html>