@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Home</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li class="active">Home</li>
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

    <div class="animated fadeIn">
        <div class="row">
            <div class="col-xl-3 col-lg-6">
                <section class="card">
                    <div class="twt-feed blue-bg">
                        <div class="corner-ribon black-ribon">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="fa fa-user wtt-mark"></div>

                        <div class="media">
                            <a href="{{route('edit')}}">
                                @if(Auth::user()->foto=="")
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" src="{{ asset('public/images/oloyfit-logo3.png') }}" alt="User Avatar">
                                @else
                                    <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" src="{{ asset(Auth::user()->foto) }}" alt="User Avatar">
                                @endif
                            </a>
                            <div class="media-body">
                                <h2 class="text-white display-6">{{Auth::user()->name}}</h2>
                                <p class="text-light">{{Auth::user()->email}}</p>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-center">Perfil</h3>

                    <div class="weather-category twt-category">
                        <ul>
                            <li class="active">
                                <a href="{{route('userinteresses.index')}}">
                                    <h5>{{$interessescount}}</h5>
                                    Interesses
                                </a>
                            </li>
                            <li>
                                <a href="{{route('profissionais.index')}}">
                                    <h5>{{$profissionaiscount}}</h5>
                                    Profissionais
                                </a>
                            </li>
                            <li>
                                <a href="{{route('empresas.index')}}">
                                    <h5>{{$empresascount}}</h5>
                                    Empresas
                                </a>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div> <!-- .content -->
@endsection
