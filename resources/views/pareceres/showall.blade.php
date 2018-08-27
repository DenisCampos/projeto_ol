@extends('layouts.sufee')

@section('page_name', 'Parecer')

@section('breadcrumbs', Breadcrumbs::render('pareceres.showall'))

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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Pareceres
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead  class="thead-dark">
                                    <tr>
                                        <th>Processo</th>
                                        <th>Situação</th>
                                        <th>Parecer</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pareceres as $parecer)
                                    <tr>
                                        <td>
                                            @if($parecer->tipo!=5 && $parecer->tipo!=6)
                                                <a href="{{$parecer->getRoute($parecer->tipo, $parecer->id_tipo)}}">
                                                    {{$parecer->getTipo($parecer->tipo)}}: 
                                                @if($parecer->tipo==1)
                                                    @if(isset($parecer->profissional->id))
                                                        {{$parecer->profissional->name}}
                                                    @else
                                                        Profissional excluido.
                                                    @endif
                                                @elseif($parecer->tipo==2)
                                                    @if(isset($parecer->empresa->id))
                                                        {{$parecer->empresa->name}}
                                                    @else
                                                        Empresa excluida.
                                                    @endif
                                                @elseif($parecer->tipo==3)
                                                    @if(isset($parecer->curso->id))
                                                        {{$parecer->curso->titulo}}
                                                    @else
                                                        InfoProdudo excluido.
                                                    @endif
                                                @elseif($parecer->tipo==4)
                                                    @if(isset($parecer->evento->id))
                                                        {{$parecer->evento->titulo}}
                                                    @else
                                                        Evento excluido.
                                                    @endif
                                                @endif
                                                </a>
                                            @elseif($parecer->tipo==5)
                                                @if(isset($parecer->bannerprof->id))
                                                    <a href="{{$parecer->getRoute($parecer->tipo, $parecer->bannerprof->profissional_id)}}">
                                                        {{$parecer->getTipo($parecer->tipo)}}:
                                                        {{$parecer->bannerprof->profissional->name}}
                                                    </a>
                                                @else
                                                    Banner excluido.
                                                @endif
                                            @elseif($parecer->tipo==6)
                                                @if(isset($parecer->banneremp->id))
                                                    <a href="{{$parecer->getRoute($parecer->tipo, $parecer->banneremp->empresa_id)}}">
                                                        {{$parecer->getTipo($parecer->tipo)}}:
                                                        {{$parecer->banneremp->empresa->name}}
                                                    </a>
                                                @else
                                                    Banner excluido.
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{$parecer->situacao->descricao}}</td>
                                        <td>{{$parecer->parecer}}</td>
                                        <td>{{date('d/m/Y H:m:s', strtotime($parecer->updated_at))}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .content -->
@endsection
