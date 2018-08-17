@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Eventos</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Eventos</li>
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
                        <strong class="card-title">Seus eventos</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Eventos criados</h3>
                        </div>
                        <hr>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="mx-auto d-block text-center">
                                <button type="button" class="btn btn-primary" onclick="window.location='{{ route("eventos.create") }}'"><i class="fa fa-globe"></i>&nbsp;Novo evento</button>
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
                                @foreach($eventos as $evento)
                                <tr>
                                    <td>{{$cont}}</td>
                                    <td>
                                        @if($evento->imagem1!="")
                                        <img class="user-avatar rounded-circle" src="{{ asset($evento->imagem1)}}" style="width:32px; height:32px;">
                                        @else
                                        <img class="user-avatar rounded-circle" src="{{ asset('public/images/oloyfit-logo3.png') }}" style="width:32px; height:32px;">
                                        @endif
                                        {{$evento->titulo}}
                                    </td>
                                    <td>{{$evento->statu->descricao}}</td>
                                    <td>{{$evento->situacao->descricao}}</td>
                                    <td class="text-center">
                                        @if($evento->situacao_id==1)
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("eventos.enviar", ['id' => $evento->id]) }}'"><i class="fa fa-share"></i> Enviar</button>
                                        @elseif($evento->situacao_id==3)
                                        <button type="button" class="btn btn-secondary" disabled><i class="fa fa-share"></i> Enviar</button>
                                        @elseif($evento->situacao_id==4)
                                        Perfil negado
                                        @else
                                        Aguardando análise administrativa
                                        @endif
                                    </td>
                                    <td class="text-center"><button type="button" class="btn btn-primary" onclick="window.location='{{ route("eventocategorias.index", ['id' => $evento->id]) }}'"><i class="fa fa-check-square-o"></i> Ações</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("eventos.show", ['id' => $evento->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-warning" onclick="window.location='{{ route("eventos.edit", ['id' => $evento->id]) }}'"><i class="fa fa-pencil-square-o"></i> Editar</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='{{ route("eventos.destroy", ['id' => $evento->id]) }}'"><i class="fa fa-trash-o"></i> Excluir</button></td>
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
