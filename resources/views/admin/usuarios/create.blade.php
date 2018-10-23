@extends('layouts.sufee')

@section('page_name', 'Novo')

@section('breadcrumbs', Breadcrumbs::render('admin.usuarios.create'))

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
                    {!! Form::open(['route' => ['admin.usuarios.store'],'class' => 'form', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Perfil</h3>
                        </div>
                        <hr>
                        @include('admin.usuarios._form')
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
