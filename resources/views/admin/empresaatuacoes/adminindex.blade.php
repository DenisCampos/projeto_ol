@extends('layouts.sufee')

@section('page_name', 'Atuações')

@section('breadcrumbs', Breadcrumbs::render('admin.empresaatuacoes.adminindex', $usuario ,$empresa))

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
                        Selecione as atuações da sua empresa
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Identificação</th>
                                    <th>Descrição</th>
                                    <th>Selecionar</th>
                                    <th>Mais Áreas</th>
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
                                    <td onclick="selecionar_atuacao('{{$atuacao->atuacaoid}}', '{{$empresa->id}}')">
                                        @if($atuacao->eatuacaoid!='')
                                        <i id="{{$atuacao->atuacaoid}}" style="color:#5cb85c" class="fa fa-toggle-on fa-2x"></i>
                                        @else
                                        <i id="{{$atuacao->atuacaoid}}" style="color:#d9534f" class="fa fa-toggle-off fa-2x"></i>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if($atuacao->subcontador>0)
                                        <button type="button" class="btn btn-primary" onclick="window.location='{{ route('admin.empresasubatuacoes.adminindex', [$usuario->id, $empresa->id, $atuacao->atuacaoid]) }}'">
                                            <i class="fa fa-check-square-o"></i> Ações
                                        </button>
                                        @endif
                                    </td>
                                </tr>
                                @php
                                    $cont++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button class="btn btn-primary btn-block" onclick="window.open('{{route('admin.empresas.useremps',[$usuario->id])}}', '_self')">Finalizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .content -->
@endsection
@section('assets_scripts')
<script>
    function selecionar_atuacao(atuacao, empresa) {
        
        var classe = document.getElementById(atuacao).getAttribute('class');
        var acao;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById(atuacao).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById(atuacao).setAttribute('style', 'color:#d9534f');
            acao = "{{route('admin.empresaatuacoes.admindestroy')}}";
        }else{
            document.getElementById(atuacao).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById(atuacao).setAttribute('style', 'color:#5cb85c');
            acao = "{{route('admin.empresaatuacoes.adminstore')}}";
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: acao,
            data: { id: atuacao, eid: empresa},
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