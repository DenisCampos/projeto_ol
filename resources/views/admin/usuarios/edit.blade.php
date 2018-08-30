@extends('layouts.sufee')

@section('page_name', $usuario->name)

@section('breadcrumbs', Breadcrumbs::render('admin.usuarios.edit', $usuario))

@section('content')
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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Edite seus dados</strong>
                    </div>
                    {!! Form::model($usuario,['route' => ['admin.usuarios.update', $usuario->id],'class' => 'form', 'method' => 'PUT', 'enctype'=>'multipart/form-data']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Perfil</h3>
                        </div>
                        <hr>
                        @include('_form')
                    </div>
                    <div class="card-footer" align="center">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-block']) !!}                       
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="feed-box text-center">
                    <section class="card">
                        <div class="card-body">
                            <div class="corner-ribon black-ribon">
                                <i class="fa fa-thumbs-up"></i>
                            </div>
                            <a href="{{ route('admin.userinteresses.adminshow',['usuario' => $usuario->id]) }}">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{ asset('public/images/Curtir.png') }}">
                                <h2>Interesses</h2>
                            </a>
                            <p>Interesses do usuário</p>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feed-box text-center">
                    <section class="card">
                        <div class="card-body">
                            <div class="corner-ribon black-ribon">
                                <i class="fa fa-user"></i>
                            </div>
                            <a href="{{ route('admin.profissionais.userprofs',['usuario' => $usuario->id]) }}">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{ asset('public/images/profissional.png') }}">
                            <h2>Perfil Profissional</h2>
                            </a>
                            <p>Perfis profissional do usuário</p>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feed-box text-center">
                    <section class="card">
                        <div class="card-body">
                            <div class="corner-ribon black-ribon">
                                <i class="fa fa-building-o"></i>
                            </div>
                            <a href="{{ route('admin.empresas.useremps',['usuario' => $usuario->id]) }}">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{ asset('public/images/empresa.png') }}">
                            <h2>Perfil da Empresa</h2>
                            </a>
                            <p>Empresa do usuário</p>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feed-box text-center">
                    <section class="card">
                        <div class="card-body">
                            <div class="corner-ribon black-ribon">
                                <i class="fa  fa-shopping-cart"></i>
                            </div>
                            <a href="{{ route('admin.cursos.usercursos',['usuario' => $usuario->id]) }}">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{ asset('public/images/infoproduto.jpeg') }}">
                            <h2>Infoprodutos</h2>
                            </a>
                            <p>Infoprodutos do usuário</p>
                        </div>
                    </section>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feed-box text-center">
                    <section class="card">
                        <div class="card-body">
                            <div class="corner-ribon black-ribon">
                                <i class="fa fa-globe"></i>
                            </div>
                            <a href="{{ route('admin.eventos.usereven',['usuario' => $usuario->id]) }}">
                                <img class="align-self-center rounded-circle mr-3" style="width:85px; height:85px;" alt="" src="{{ asset('public/images/eventos.jpeg') }}">
                            <h2>Eventos</h2>
                            </a>
                            <p>Eventos do usuário</p>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function pega_estados(pais) {
        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('estados.pegaestados')}}",
            data: {id: pais},
            success: function (res)
            {  
                if(res)
                {
                    $('#carrega_estados').html(res);
                }
            }
        });	
    };
    
    function pega_cidades(estado) {
        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('cidades.pegacidades')}}",
            data: {id: estado},
            success: function (res)
            {  
                if(res)
                {
                    $('#carrega_cidades').html(res);
                }
            }
        });	
    };
</script>
@endsection
