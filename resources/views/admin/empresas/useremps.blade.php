@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Empresa</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('admin.usuarios.index')}}">Usuários</a></li>
                    <li><a href="{{route('admin.usuarios.edit',['id' => $usuario])}}">Detalhar</a></li>
                    <li class="active">Empresas</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                <span class="badge badge-pill badge-warning"><i class="fa fa-warning"></i> Atenção</span>
                    Qualquer edição altera os status para "Não Publicado" e retorna para a situação para "Criado".
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>
    @if(Session::has('message'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Sucesso</span>  {!! Session::get('message') !!}
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
                        <strong class="card-title">Suas empresas</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Perfil da Empresa</h3>
                        </div>
                        <hr>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="mx-auto d-block text-center">
                                <button type="button" class="btn btn-primary" onclick="window.location='{{ route("empresas.create") }}'"><i class="fa fa-building-o"></i>&nbsp;Nova empresa</button>
                            </div>
                        </div>
                        <div class="col-lg-4"></div><br><br>
                        <table class="table table-responsive">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Status</th>
                                <th scope="col">Situação</th>
                                <th scope="col" class="text-center">Destaque</th>
                                <th scope="col" class="text-center" width="8%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont=1;
                                @endphp
                                @foreach($empresas as $empresa)
                                <tr>
                                    <td>{{$cont}}</td>
                                    <td>
                                        @if($empresa->imagem1!="")
                                        <img class="user-avatar" src="{{ asset($empresa->imagem1)}}" style="height:32px;">
                                        @else
                                        <img class="user-avatar" src="{{ asset('images/oloyfit-logo3.png') }}" style="height:32px;">
                                        @endif
                                        {{$empresa->name}}
                                    </td>
                                    <td>{{$empresa->statu->descricao}}</td>
                                    <td>{{$empresa->situacao->descricao}}</td>
                                    <td class="text-center" onclick="liberar_destaque('{{$empresa->id}}')">
                                        @if($empresa->destaque_id=='2')
                                        <i id="destaque{{$empresa->id}}" style="color:#5cb85c" class="fa fa-toggle-on fa-2x"></i>
                                        @else
                                        <i id="destaque{{$empresa->id}}" style="color:#d9534f" class="fa fa-toggle-off fa-2x"></i>
                                        @endif
                                    </td>                                    
                                    <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("admin.empresas.adminshow", ['id' => $empresa->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
                                </tr>
                                @php
                                    $cont++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .content -->
<script>
     function liberar_destaque(empresa) {
        
        var classe = document.getElementById('destaque'+empresa).getAttribute('class');
        var acao, valor;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById('destaque'+empresa).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById('destaque'+empresa).setAttribute('style', 'color:#d9534f');
            valor = 1;
        }else{
            document.getElementById('destaque'+empresa).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById('destaque'+empresa).setAttribute('style', 'color:#5cb85c');
            valor = 2;
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('admin.empresas.liberadestaque')}}",
            data: { id: empresa, destaque_id: valor},
            dataType: 'json',
            success: function (res)
            {  
                if(res)
                {
                                            
                }
            }
        });	
    };
</script>
@endsection
