@extends('layouts.sufee')

@section('page_name', 'Sub Atuações')

@section('breadcrumbs', Breadcrumbs::render('profissionalsubatuacoes.index', $profissional,$atuacao))

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
                        Selecione as atuações do seu perfil profissional
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
                                    <td onclick="selecionar_subatuacao('{{$subatuacao->sub_atuacoesid}}', '{{$profissional->id}}')">
                                        @if($subatuacao->psubatuacaoid!='')
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
                        <button class="btn btn-primary btn-block" onclick="window.open('{{route('profissionais.index')}}', '_self')">Finalizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .content -->

@endsection

@section('assets_scripts')
<script>

    function selecionar_subatuacao(subatuacao, profissional) {
        
        var classe = document.getElementById(subatuacao).getAttribute('class');
        var acao;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById(subatuacao).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById(subatuacao).setAttribute('style', 'color:#d9534f');
            acao = "{{route('profissionalsubatuacoes.destroy')}}";
        }else{
            document.getElementById(subatuacao).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById(subatuacao).setAttribute('style', 'color:#5cb85c');
            acao = "{{route('profissionalsubatuacoes.store')}}";
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: acao,
            data: { id: subatuacao, pid: profissional},
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
