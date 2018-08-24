@extends('layouts.sufee')

@section('page_name', 'Empresa')

@section('breadcrumbs', Breadcrumbs::render('empresas.index'))

@section('content')

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
                                <th scope="col" class="text-center">Ação</th>
                                <th scope="col" class="text-center" width="8%"></th>
                                <th scope="col" class="text-center" width="8%"></th>
                                <th scope="col" class="text-center" width="8%"></th>
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
                                    <td class="text-center">
                                        @if($empresa->situacao_id==1)
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("empresas.enviar", ['id' => $empresa->id]) }}'"><i class="fa fa-share"></i> Enviar</button>
                                        @elseif($empresa->situacao_id==3)
                                            @if($empresa->banner==1)
                                            <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("empresabanners.index", ['empresa' => $empresa->id]) }}'"><i class="fa fa-picture-o"></i> Adicionar Banner</button>
                                            @else
                                            <button type="button" class="btn btn-secondary" disabled><i class="fa fa-picture-o"></i> Adicionar Banner</button>
                                            @endif
                                        @elseif($empresa->situacao_id==4)
                                        Perfil negado
                                        @else
                                        Aguardando análise administrativa
                                        @endif
                                    </td>
                                    <td class="text-center"><button type="button" class="btn btn-primary" onclick="window.location='{{ route("empresaatuacoes.index", ['id' => $empresa->id]) }}'"><i class="fa fa-check-square-o"></i> Atuações</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("empresas.show", ['id' => $empresa->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-warning" onclick="window.location='{{ route("empresas.edit", ['id' => $empresa->id]) }}'"><i class="fa fa-pencil-square-o"></i> Editar</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='{{ route("empresas.destroy", ['id' => $empresa->id]) }}'"><i class="fa fa-trash-o"></i> Excluir</button></td>
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
@endsection
