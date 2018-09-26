@extends('layouts.sufee')

@section('page_name', 'Enviados')

@section('breadcrumbs', Breadcrumbs::render('admin.eventos.enviados'))

@section('content')
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
                        <strong class="card-title">Eventos dos usuários</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Eventos Enviados</h3>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="bootstrap-data-table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Situação</th>
                                    <th scope="col" class="text-center">Destaque</th>
                                    <th scope="col" class="text-center" width="8%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont=1;
                                    @endphp
                                    @foreach($eventos as $evento)
                                    <tr>
                                        <td>{{$cont}}</td>
                                        <td>
                                            @if($evento->imagem1!="")
                                            <img class="user-avatar rounded-circle" src="{{ asset($evento->imagem1)}}" style="width:32px; height:32px;">
                                            @else
                                            <img class="user-avatar rounded-circle" src="{{ asset('public/images/oloyfit-logo3.png') }}" style="width:32px; height:32px;">
                                            @endif
                                            {{$evento->titulo}}
                                        </td>
                                        <td>{{$evento->statu->descricao}}</td>
                                        <td>{{$evento->situacao->descricao}}</td>
                                        <td class="text-center" onclick="liberar_destaque('{{$evento->id}}')">
                                            @if($evento->destaque_id=='2')
                                            <i id="destaque{{$evento->id}}" style="color:#5cb85c" class="fa fa-toggle-on fa-2x"></i>
                                            @else
                                            <i id="destaque{{$evento->id}}" style="color:#d9534f" class="fa fa-toggle-off fa-2x"></i>
                                            @endif
                                        </td>
                                        <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("admin.eventos.adminshow", [$evento->user_id, $evento->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
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
@endsection
@section('assets_scripts')
<script>
    function liberar_destaque(evento) {
        
        var classe = document.getElementById('destaque'+evento).getAttribute('class');
        var acao, valor;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById('destaque'+evento).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById('destaque'+evento).setAttribute('style', 'color:#d9534f');
            valor = 1;
        }else{
            document.getElementById('destaque'+evento).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById('destaque'+evento).setAttribute('style', 'color:#5cb85c');
            valor = 2;
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('admin.eventos.liberadestaque')}}",
            data: { id: evento, destaque_id: valor},
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

