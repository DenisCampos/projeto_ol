@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Sub Atuações</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('edit')}}">Dados Pessoais</a></li>
                    <li><a href="{{route('empresas.index')}}">Profissional</a></li>
                    <li><a href="{{route('empresaatuacoes.index',[$empresa])}}">Atuações</a></li>
                    <li class="active">Sub Atuações</li>
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
                        Selecione as atuações do seu perfil empresa
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Identificação</th>
                                    <th>Descrição</th>
                                    <th>Selecionar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont=1;
                                @endphp
                                @foreach($subatuacoes as $subatuacao)
                                <tr>
                                    <td>{{$cont}}</td>
                                    <td>{{$subatuacao->descricao}}</td>
                                    <td onclick="selecionar_subatuacao('{{$subatuacao->sub_atuacoesid}}', '{{$empresa}}')">
                                        @if($subatuacao->esubatuacaoid!='')
                                        <i id="{{$subatuacao->sub_atuacoesid}}" style="color:#5cb85c" class="fa fa-toggle-on fa-2x"></i>
                                        @else
                                        <i id="{{$subatuacao->sub_atuacoesid}}" style="color:#d9534f" class="fa fa-toggle-off fa-2x"></i>
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
                        <button class="btn btn-primary btn-block" onclick="window.open('{{route('empresas.index')}}', '_self')">Finalizar</button>
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

    function selecionar_subatuacao(subatuacao, empresa) {
        
        var classe = document.getElementById(subatuacao).getAttribute('class');
        var acao;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById(subatuacao).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById(subatuacao).setAttribute('style', 'color:#d9534f');
            acao = "{{route('empresasubatuacoes.destroy')}}";
        }else{
            document.getElementById(subatuacao).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById(subatuacao).setAttribute('style', 'color:#5cb85c');
            acao = "{{route('empresasubatuacoes.store')}}";
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: acao,
            data: { id: subatuacao, eid: empresa},
            dataType: 'json',
            success: function (res)
            {  
                if(res)
                {
                    console.log(res);
                }
            }
        });	
    };
</script>
@endsection