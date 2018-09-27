@extends('layouts.site')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Selecione os assuntos interessados
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
                                <td onclick="selecionar_categoria('{{$categoria->categoriaid}}')">
                                    @if($categoria->interessesid!='')
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
                    <button class="btn btn-primary btn-block" onclick="window.open('{{route('index')}}', '_self')">Finalizar</button>
                </div>
            </div>
        </div>
    </div>
</div> <!-- .content -->
@endsection

@section('assets_scripts')
<script>
    $(document).ready(function() {
       $('#bootstrap-data-table-export').DataTable();
   } );

   function selecionar_categoria(categoria) {
       
       var classe = document.getElementById(categoria).getAttribute('class');
       var acao;
       
       if (classe == 'fa fa-toggle-on fa-2x'){
           document.getElementById(categoria).setAttribute('class', 'fa fa-toggle-off fa-2x');
           document.getElementById(categoria).setAttribute('style', 'color:#d9534f');
           acao = "{{route('userinteresses.destroy')}}";
       }else{
           document.getElementById(categoria).setAttribute('class', 'fa fa-toggle-on fa-2x');
           document.getElementById(categoria).setAttribute('style', 'color:#5cb85c');
           acao = "{{route('userinteresses.store')}}";
       }

       jQuery.ajax({
           headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
           type:"POST",
           url: acao,
           data: { id: categoria},
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
