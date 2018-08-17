@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Novo</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('edit')}}">Dados Pessoais</a></li>
                    <li><a href="{{route('profissionais.index')}}">Profissional</a></li>
                    <li <a href="{{ route("profissionalbanners.index", ['profissional' => $profissional->id])}}">Banner</a></li>
                    <li class="active">Novo</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    @if(Session::has('message'))
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Sucesso</span>  {!! Session::get('message') !!}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    @endif
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Crie um novo banner</strong>
                    </div>
                    {!! Form::open(['route' => ['profissionalbanners.store', 'profissional' => $profissional->id],'class' => 'form', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Dados do Banner</h3>
                        </div>
                        <hr>
                        @include('profissionalbanners._form')
                    </div>
                    <div class="card-footer" align="center">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-block']) !!}                       
                    </div>
                    {!! Form::close() !!}
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
