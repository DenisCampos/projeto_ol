@extends('layouts.sufee')

@section('page_name', 'Parecer')

@section('breadcrumbs', Breadcrumbs::render('pareceres.show', $parecer))

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
                                    <tr>
                                        <td>
                                        @if($parecer->tipo!=5 && $parecer->tipo!=6)   
                                        <a href="{{$parecer->getRoute($parecer->tipo, $dados->id)}}">
                                            {{$parecer->getTipo($parecer->tipo)}} 
                                            @if($parecer->tipo==1 || $parecer->tipo==2)
                                                {{$dados->name}}
                                            @else
                                                {{$dados->titulo}}
                                            @endif
                                        </a>
                                        @elseif($parecer->tipo==5)
                                        <a href="{{$parecer->getRoute($parecer->tipo, $dados->profissional_id)}}">
                                            {{$parecer->getTipo($parecer->tipo)}}: 
                                            {{$dados->profissional->name}}
                                        </a>
                                        @elseif($parecer->tipo==6)
                                        <a href="{{$parecer->getRoute($parecer->tipo, $dados->empresa_id)}}">
                                            {{$parecer->getTipo($parecer->tipo)}}:
                                            {{$dados->empresa->name}}
                                        </a>
                                        @endif
                                        </td>
                                        <td>{{$parecer->situacao->descricao}}</td>
                                        <td>{{$parecer->parecer}}</td>
                                        <td>{{date('d/m/Y H:m:s', strtotime($parecer->updated_at))}}</td>
                                    </tr>
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
