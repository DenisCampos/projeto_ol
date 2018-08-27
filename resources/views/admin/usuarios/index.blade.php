@extends('layouts.sufee')

@section('page_name', 'Usuários')

@section('breadcrumbs', Breadcrumbs::render('admin.usuarios.index'))

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
                        Usuários Cadastrados
                    </div>
                    <div class="card-body">
                        <table id="bootstrap-data-table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>E-mail</th>
                                    <th>Detalhar</th>
                                    <th>Admin</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont=1;
                                @endphp
                                @foreach($usuarios as $usuario)
                                <tr>
                                    <td>{{$cont}}</td>
                                    <td>
                                        @if($usuario->foto!="")
                                        <img class="user-avatar rounded-circle" src="{{ asset($usuario->foto)}}" style="width:32px; height:32px;">
                                        @else
                                        <img class="user-avatar rounded-circle" src="{{ asset('public/images/oloyfit-logo3.png') }}" style="width:32px; height:32px;">
                                        @endif
                                        {{$usuario->name}}
                                    </td>
                                    <td>{{$usuario->email}}</td>
                                    <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("admin.usuarios.edit", ['id' => $usuario->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
                                    <td onclick="selecionar_tipo('{{$usuario->id}}')">
                                        @if($usuario->tipo=='1')
                                        <i id="{{$usuario->id}}" style="color:#5cb85c" class="fa fa-toggle-on fa-2x"></i>
                                        @else
                                        <i id="{{$usuario->id}}" style="color:#d9534f" class="fa fa-toggle-off fa-2x"></i>
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
                </div>
            </div>
        </div>
    </div>
</div> <!-- .content -->
<script>
    $(document).ready(function() {
        $('#bootstrap-data-table-export').DataTable();
    } );

    function selecionar_tipo(usuario) {
        
        var classe = document.getElementById(usuario).getAttribute('class');
        var acao;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById(usuario).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById(usuario).setAttribute('style', 'color:#d9534f');
            acao = "{{route('admin.usuarios.tipouser')}}";
        }else{
            document.getElementById(usuario).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById(usuario).setAttribute('style', 'color:#5cb85c');
            acao = "{{route('admin.usuarios.tipoadmin')}}";
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: acao,
            data: { id: usuario},
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
