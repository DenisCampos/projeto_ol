@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Atuações</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Atuações</li>
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
                        <strong class="card-title">Atuações cadastradas</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Atuações</h3>
                        </div>
                        <hr>
                        <div class="col-md-6 offset-md-3">
                            <div class="mx-auto d-block text-center">
                                <button type="button" class="btn btn-primary" onclick="window.location='{{ route("admin.atuacoes.create") }}'"><i class="fa fa-table"></i>&nbsp;Nova atuação</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="bootstrap-data-table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Descricao</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont=1;
                                    @endphp
                                    @foreach($atuacoes as $atuacao)
                                    <tr>
                                        <td>{{$cont}}</td>
                                        <td>{{$atuacao->descricao}}</td>
                                        <td>{{$atuacao->tipo($atuacao->tipo)}}</td>
                                        <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("admin.subatuacoes.index", ['id' => $atuacao->id]) }}'"><i class="fa fa-check-square-o"></i> SubAtuações</button></td>
                                        <td class="text-center"><button type="button" class="btn btn-warning" onclick="window.location='{{ route("admin.atuacoes.edit", ['id' => $atuacao->id]) }}'"><i class="fa fa-pencil-square-o"></i> Editar</button></td>
                                        <td class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='{{ route("admin.atuacoes.destroy", ['id' => $atuacao->id]) }}'"><i class="fa fa-trash-o"></i> Excluir</button></td>
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
    </div>
</div> <!-- .content -->
<script>
    $(document).ready(function() {
       $('#bootstrap-data-table-export').DataTable();
   } );
</script>

@endsection
