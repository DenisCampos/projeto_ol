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
                    <li><a href="{{route('admin.usuarios.index')}}">Usuários</a></li>
                    <li><a href="{{route('admin.usuarios.edit',['usuario'=>$profissional->user_id])}}">Detalhar</a></li>
                    <li><a href="{{route('admin.profissionais.userprofs',['usuario' => $profissional->user_id])}}">Profissões</a></li>
                    <li><a href="{{route('admin.profissionalbanners.bannerprofs',['profissional' => $profissional->id])}}">Banners</a></li>
                    <li class="active">Banner</li>
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
            <div class="col-md-6">
                <aside class="profile-nav alt">
                    <section class="card">
                        <a href="{{$banner->site}}" target="_blank">
                        @if(isset($banner->banner)!="")
                            <img class="card-img-top img-responsive" src="{{ asset($banner->banner) }}"    alt="Card image cap">
                        @else
                            <img class="align-self-center rounded-circle mr-3" src="{{ asset('public/images/oloyfit-logo3.png') }}" alt="Card image cap">
                        @endif
                        </a>
                        Profissional: {{$profissional->name}}
                        @if($banner->situacao_id==2||$banner->situacao_id==3)
                        <div class="card-footer">
                            {!! Form::model($banner,['route' => ['admin.profissionalbanners.analise', $profissional->id],'class' => 'form', 'method' => 'PUT', 'name' => 'form_parecer', 'id' => 'form_parecer']) !!}
                            {!! Form::hidden('id', $banner->id) !!}
                            {!! Form::hidden('user_id', $profissional->user_id) !!}
                            {!! Form::hidden('analise', '', ['id' => "analise"]) !!}
                            <div class="col-lg-12">
                                {!! Form::label('parecer', 'Parecer*', ['class' => 'control-label']) !!}
                                {!! Form::textarea('parecer', null, ['rows' => "3",'class' => 'form-control', 'required' => 'required']) !!}<br>
                            </div>
                            <div class="col-lg-6">
                                {!! Form::label('data_inicio', 'Inicio', ['class' => 'control-label']) !!}
                                {!! Form::date('data_inicio', null, ['class' => 'form-control']) !!}<br>
                            </div>
                            <div class="col-lg-6">
                                {!! Form::label('data_fim', 'Fim', ['class' => 'control-label']) !!}
                                {!! Form::date('data_fim', null, ['class' => 'form-control']) !!}<br>
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
    function coloca_analise(bvalor){
        $("#analise").val(bvalor);
    }
</script>
@endsection
