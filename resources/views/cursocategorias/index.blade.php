@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Categorias</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('cursos.index')}}">Cursos</a></li>
                    <li class="active">Categorias</li>
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
                        Selecione as categorias interessadas
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
                                @foreach($categorias as $categoria)
                                <tr>
                                    <td>{{$cont}}</td>
                                    <td>{{$categoria->descricao}}</td>
                                    <td onclick="selecionar_categoria('{{$categoria->categoriaid}}','{{$cursoid}}')">
                                        @if($categoria->categoria_curso!='')
                                        <i id="{{$categoria->categoriaid}}" style="color:#5cb85c" class="fa fa-toggle-on fa-2x"></i>
                                        @else
                                        <i id="{{$categoria->categoriaid}}" style="color:#d9534f" class="fa fa-toggle-off fa-2x"></i>
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
                        <button class="btn btn-primary btn-block" onclick="window.open('{{route('cursos.index')}}', '_self')">Finalizar</button>
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

    function selecionar_categoria(categoria, curso) {
        
        var classe = document.getElementById(categoria).getAttribute('class');
        var acao;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById(categoria).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById(categoria).setAttribute('style', 'color:#d9534f');
            acao = "{{route('cursocategorias.destroy')}}";
        }else{
            document.getElementById(categoria).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById(categoria).setAttribute('style', 'color:#5cb85c');
            acao = "{{route('cursocategorias.store')}}";
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: acao,
            data: { id: categoria, idc: curso},
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
