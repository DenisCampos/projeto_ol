@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Banner</h1>
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
                    <li class="active">Banner</li>
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
                    Qualquer edição altera os status do <strong>Banner</strong> para "Não Publicado" e retorna para a situação para "Criado".
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="sufee-alert alert with-close alert-warning alert-dismissible fade show">
                <span class="badge badge-pill badge-warning"><i class="fa fa-warning"></i> Atenção</span>
                    Você tem o limite de até <strong>2</strong> Banners.
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
                        <strong class="card-title">Profissional: {{$profissional->name}}</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Banners</h3>
                        </div>
                        <hr>
                        @if(count($banners)<2)
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <div class="mx-auto d-block text-center">
                                <button type="button" class="btn btn-primary" onclick="window.location='{{ route("profissionalbanners.create", ['profissional' => $profissional->id]) }}'"><i class="fa fa-picture-o"></i>&nbsp;Novo banner</button>
                            </div>
                        </div>
                        <div class="col-lg-4"></div><br><br>
                        @endif
                        <table class="table table-responsive">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Banner</th>
                                <th scope="col">Status</th>
                                <th scope="col">Situação</th>
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
                                @foreach($banners as $banner)
                                <tr>
                                    <td>{{$cont}}</td>
                                    <td>
                                        @if($banner->banner!="")
                                        <img src="{{ asset($banner->banner)}}" style="width:200px; height:50px;">
                                        @else
                                        <img class="user-avatar rounded-circle" src="{{ asset('public/images/oloyfit-logo3.png') }}" style="width:32px; height:32px;">
                                        @endif
                                    </td>
                                    <td>{{$banner->statu->descricao}}</td>
                                    <td>{{$banner->situacao->descricao}}</td>
                                    <td class="text-center">
                                        @if($banner->situacao_id==1)
                                        <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("profissionalbanners.enviar", ['profissional' => $profissional->id, 'id' => $banner->id]) }}'"><i class="fa fa-share"></i> Enviar</button>
                                        @elseif($banner->situacao_id==3)
                                        Aceito
                                        @elseif($banner->situacao_id==4)
                                        Banner negado
                                        @else
                                        Aguardando análise administrativa
                                        @endif
                                    </td>
                                    <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("profissionalbanners.show", ['profissional' => $profissional->id, 'id' => $banner->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-warning" onclick="window.location='{{ route("profissionalbanners.edit", ['profissional' => $profissional->id, 'id' => $banner->id]) }}'"><i class="fa fa-pencil-square-o"></i> Editar</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='{{ route("profissionalbanners.destroy", ['profissional' => $profissional->id, 'id' => $banner->id]) }}'"><i class="fa fa-trash-o"></i> Excluir</button></td>
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
