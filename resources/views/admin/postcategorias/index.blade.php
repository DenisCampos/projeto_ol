@extends('layouts.sufee')

@section('page_name', 'Categorias')

@section('breadcrumbs', Breadcrumbs::render('admin.postcategorias.index', $post))

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
                                    <td onclick="selecionar_categoria('{{$categoria->categoriaid}}','{{$post->id}}')">
                                        @if($categoria->categoria_post!='')
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
                        <button class="btn btn-primary btn-block" onclick="window.open('{{route('admin.posts.index')}}', '_self')">Finalizar</button>
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

    function selecionar_categoria(categoria, post) {
        
        var classe = document.getElementById(categoria).getAttribute('class');
        var acao;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById(categoria).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById(categoria).setAttribute('style', 'color:#d9534f');
            acao = "{{route('admin.postcategorias.destroy')}}";
        }else{
            document.getElementById(categoria).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById(categoria).setAttribute('style', 'color:#5cb85c');
            acao = "{{route('admin.postcategorias.store')}}";
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: acao,
            data: { id: categoria, idp: post},
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
