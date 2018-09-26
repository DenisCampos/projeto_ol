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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="OloyFit, conectando pessoas que buscam um estilo de vida saudável.">
    <meta name="keywords" content="OloyFit, oloyfit, vida saudavel, bem estar, suplementos" >
    <meta name="keywords" content="alimentacao saudavel, nutricionistas, nutrólogos, personal trainer" >
    <meta name="author" content="OloyFit">
    <meta name="robot" content="all" >
    <meta name="googlebot" content="all">
    <meta name="google-site-verification" content="iMnIjKg586mnbtTv_Tx4EFLcyFkmoSDPEZ4nHcV3GRM" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} {{ config('app.subtitle', 'Laravel') }}</title>

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="{{ asset('public/images/oloyfitico.ico') }}">

    <link rel="stylesheet" href="{{ asset('public/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/lib/datatable/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/scss/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/scss/socials.css') }}">
    <link rel="stylesheet" href="{{ asset('public/css/custom-sistema.css') }}">
    <link href="{{ asset('public/assets/css/lib/vector-map/jqvmap.min.css') }}" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
    @yield('assets_css')

</head>
<body>
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" style="margin-top:0px" href="{{route('index')}}"><img src="{{ asset('public/images/cropped-oloyfit-logo.png') }}" alt="Logo"></a>
                <a class="navbar-brand hidden" href="{{route('index')}}"><img src="{{ asset('public/images/oloyfit-logo3.png') }}" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{route('index')}}"> <i class="menu-icon fa fa-external-link"></i>Site</a>
                    </li>
                    <li  class="{{ request()->is('home') ? 'active' : '' }}">
                        <a href="{{route('home')}}"> <i class="menu-icon fa fa-home"></i>Home</a>
                    </li>
                    <h3 class="menu-title">Para você</h3><!-- /.menu-title -->
                    <li  class="{{ request()->is('userinteresses') ? 'active' : '' }}">
                        <a href="{{route('userinteresses.index')}}"> <i class="menu-icon fa fa-thumbs-up"></i>Interesses</a>
                    </li>
                    <h3 class="menu-title">Para parceiros</h3><!-- /.menu-title -->
                    <li class="menu-item-has-children dropdown {{ request()->is('profissionais*') ? 'active' : '' }} {{ request()->is('profissionalatuacoes*') ? 'active' : '' }}  {{ request()->is('profissionalsubatuacoes*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Profissional</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-card-o"></i><a href="{{route('profissionais.create')}}">Novo</a></li>
                            <li><i class="fa fa-file-text-o"></i><a href="{{route('profissionais.index')}}">Cadastrados</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown {{ request()->is('empresas*') ? 'active' : '' }} {{ request()->is('empresaatuacoes*') ? 'active' : '' }}  {{ request()->is('empresasubatuacoes*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-building-o"></i>Empresa</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-card-o"></i><a href="{{route('empresas.create')}}">Novo</a></li>
                            <li><i class="fa fa-file-text-o"></i><a href="{{route('empresas.index')}}">Cadastrados</a></li>
                        </ul>
                    </li>
                    @if(Auth::user()->tipo==1)
                    <li class="menu-item-has-children dropdown {{ request()->is('cursos*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart"></i>Infoprodutos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-card-o"></i><a href="{{route('cursos.create')}}">Novo</a></li>
                            <li><i class="fa fa-file-text-o"></i><a href="{{route('cursos.index')}}">Cadastrados</a></li>
                        </ul>
                    </li>
                    @endif
                    <li class="menu-item-has-children dropdown {{ request()->is('eventos*') ? 'active' : '' }} {{ request()->is('eventocategorias*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-globe"></i>Eventos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-id-card-o"></i><a href="{{route('eventos.create')}}">Novo</a></li>
                            <li><i class="fa fa-file-text-o"></i><a href="{{route('eventos.index')}}">Cadastrados</a></li>
                        </ul>
                    </li>
                    @if(Auth::user()->tipo==1)
                    <h3 class="menu-title">Administrador</h3><!-- /.menu-title -->
                    <li  class="{{ request()->is('admin/usuarios*') ? 'active' : '' }}">
                        <a href="{{route('admin.usuarios.index')}}"> <i class="menu-icon fa fa-users"></i>Usuarios</a>
                    </li>
                    <li class="menu-item-has-children dropdown {{ request()->is('admin/profissionais*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user"></i>Profissionais</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-mail-forward"></i><a href="{{route('admin.profissionais.enviados')}}">Enviados</a></li>
                            <li><i class="fa fa-check"></i><a href="{{route('admin.profissionais.aprovados')}}">Aprovados</a></li>
                            <li><i class="fa fa-ban"></i><a href="{{route('admin.profissionais.negados')}}">Negados</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown {{ request()->is('admin/empresas*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-building-o"></i>Empresas</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-mail-forward"></i><a href="{{route('admin.empresas.enviados')}}">Enviados</a></li>
                            <li><i class="fa fa-check"></i><a href="{{route('admin.empresas.aprovados')}}">Aprovados</a></li>
                            <li><i class="fa fa-ban"></i><a href="{{route('admin.empresas.negados')}}">Negados</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown {{ request()->is('admin/cursos*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart"></i>Infoprodutos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-mail-forward"></i><a href="{{route('admin.cursos.enviados')}}">Enviados</a></li>
                            <li><i class="fa fa-check"></i><a href="{{route('admin.cursos.aprovados')}}">Aprovados</a></li>
                            <li><i class="fa fa-ban"></i><a href="{{route('admin.cursos.negados')}}">Negados</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown {{ request()->is('admin/eventos*') ? 'active' : '' }}">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-globe"></i>Eventos</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-mail-forward"></i><a href="{{route('admin.eventos.enviados')}}">Enviados</a></li>
                            <li><i class="fa fa-check"></i><a href="{{route('admin.eventos.aprovados')}}">Aprovados</a></li>
                            <li><i class="fa fa-ban"></i><a href="{{route('admin.eventos.negados')}}">Negados</a></li>
                        </ul>
                    </li>
                    <h3 class="menu-title">Cadastros</h3><!-- /.menu-title -->
                    <li class="{{ request()->is('admin/bannersprincipais*') ? 'active' : '' }}">
                        <a href="{{route('admin.bannersprincipais.index')}}"> <i class="menu-icon fa fa-image"></i>Banners Principais</a>
                    </li>
                    <li class="{{ request()->is('admin/posts*') ? 'active' : '' }}">
                        <a href="{{route('admin.posts.index')}}"> <i class="menu-icon fa fa-laptop"></i>Posts</a>
                    </li>
                    <li class="{{ request()->is('admin/categorias*') ? 'active' : '' }}">
                        <a href="{{route('admin.categorias.index')}}"> <i class="menu-icon fa fa-th"></i>Categorias</a>
                    </li>
                    <li class="{{ request()->is('admin/atuacoes*') ? 'active' : '' }} {{ request()->is('admin/*/subatuacoes*') ? 'active' : '' }}">
                        <a href="{{route('admin.atuacoes.index')}}"> <i class="menu-icon fa fa-table"></i>Atuações</a>
                    </li>  
                    <li class="{{ request()->is('admin/paises*') ? 'active' : '' }} {{ request()->is('admin/*/estados*') ? 'active' : '' }} {{ request()->is('admin/*/*/cidades*') ? 'active' : '' }}">
                        <a href="{{route('admin.paises.index')}}"> <i class="menu-icon fa fa-map-o"></i>Localidades</a>
                    </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <div class="dropdown for-notification" id="pega_avisos">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">0</span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @if(Auth::user()->foto=="")
                                <img class="user-avatar rounded-circle" src="{{ asset('public/images/oloyfit-logo3.png') }}" alt="User Avatar">
                            @else
                                <img class="user-avatar rounded-circle" src="{{ asset(Auth::user()->foto) }}" alt="User Avatar">
                            @endif
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="{{route('edit')}}"><i class="fa fa-user"></i> Meu Perfil</a>
                            <a class="nav-link" href="{{route('password')}}"><i class="fa fa-ellipsis-h"></i> Alterar Senha</a>
                            <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fa fa-power-off"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->
        <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>@yield('page_name')</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                             @yield('breadcrumbs')
                        </div>
                    </div>
                </div>
            </div>
        @yield('content')
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="{{ asset('public/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="{{ asset('public/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('public/assets/js/main.js') }}"></script>
    <script src="{{ asset('public/assets/js/popper.min.js') }}"></script>

    <script src="{{ asset('public/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/pdfmake.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/data-table/datatables-init.js') }}"></script>

    <script src="{{ asset('public/assets/js/lib/chart-js/Chart.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('public/assets/js/widgets.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/vector-map/jquery.vmap.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/vector-map/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/vector-map/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('public/assets/js/lib/vector-map/country/jquery.vmap.world.js') }}"></script>
    <script>
        $(document).ready(function() {
            jQuery.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type:"GET",
                url: "{{route('avisos')}}",
                success: function (res)
                {  
                    if(res)
                    {
                        $('#pega_avisos').html(res);
                    }
                }
            });	

            $('#bootstrap-data-table-export').DataTable();
        });
    </script>
    @yield('assets_scripts')
</body>
</html>
