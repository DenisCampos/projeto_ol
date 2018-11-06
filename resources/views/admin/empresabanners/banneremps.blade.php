@extends('layouts.sufee')

@section('page_name', 'Banners')

@section('breadcrumbs', Breadcrumbs::render('admin.empresabanners.banneremps', $usuario, $empresa))

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
                    <strong class="card-title">Banners do empresa {{$empresa->name}}</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Banners</h3>
                        </div>
                        <hr>
                        @if(count($banners)<2)
                        <div class="col-md-6 offset-md-3 pb-2">
                            <div class="mx-auto d-block text-center">
                                <button type="button" class="btn btn-primary" onclick="window.location='{{ route('admin.empresabanners.admincreate', [$usuario->id, $empresa->id]) }}'"><i class="fa fa-user"></i>&nbsp;Novo Banner</button>
                            </div>
                        </div>
                        @endif
                        <table class="table table-responsive">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Banner</th>
                                <th scope="col">Status</th>
                                <th scope="col">Situação</th>
                                <th scope="col">Inicio</th>
                                <th scope="col">Fim</th>
                                <th scope="col" class="text-center" width="8%"></th>
                                <th scope="col" class="text-center" width="8%"></th>
                                <th scope="col" class="text-center" width="8%"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont=1;
                                @endphp
                                @foreach($banners as $banner)
                                <tr>
                                    <td>{{$cont}}</td>
                                    <td>
                                        @if($banner->banner!="")
                                        <img src="{{ asset($banner->banner)}}" style="width:200px; height:50px;">
                                        @else
                                        <img class="user-avatar rounded-circle" src="{{ asset('public/images/oloyfit-logo3.png') }}" style="width:32px; height:32px;">
                                        @endif
                                    </td>
                                    <td>{{$banner->statu->descricao}}</td>
                                    <td>{{$banner->situacao->descricao}}</td>
                                    <td>
                                        @if(!is_null($banner->data_inicio))
                                        {{date('d/m/Y', strtotime($banner->data_inicio))}}
                                        @endif
                                    </td>
                                    <td>
                                        @if(!is_null($banner->data_fim))
                                        {{date('d/m/Y', strtotime($banner->data_fim))}}
                                        @endif
                                    </td>
                                    <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route('admin.empresabanners.adminshow', [ $usuario->id, $empresa->id, $banner->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-warning" onclick="window.location='{{ route('admin.empresabanners.adminedit', [ $usuario->id, $empresa->id, $banner->id]) }}'"><i class="fa fa-pencil-square-o"></i> Editar</button></td>
                                    <td class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='{{ route('admin.empresabanners.admindestroy', [$usuario->id, $empresa->id, $banner->id]) }}'"><i class="fa fa-trash-o"></i> Excluir</button></td>
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
@endsection
@section('assets_scripts')
<script>
    function liberar_banner(empresa) {
        
        var classe = document.getElementById('banner'+empresa).getAttribute('class');
        var valor;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById('banner'+empresa).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById('banner'+empresa).setAttribute('style', 'color:#d9534f');
            valor = 0;
        }else{
            document.getElementById('banner'+empresa).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById('banner'+empresa).setAttribute('style', 'color:#5cb85c');
            valor = 1;
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('admin.empresas.liberabanner')}}",
            data: { id: empresa, banner: valor},
            dataType: 'json',
            success: function (res)
            {  
                if(res)
                {
                                            
                }
            }
        });	
    };

    function liberar_destaque(empresa) {
        
        var classe = document.getElementById('destaque'+empresa).getAttribute('class');
        var acao, valor;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById('destaque'+empresa).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById('destaque'+empresa).setAttribute('style', 'color:#d9534f');
            valor = 1;
        }else{
            document.getElementById('destaque'+empresa).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById('destaque'+empresa).setAttribute('style', 'color:#5cb85c');
            valor = 2;
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('admin.empresas.liberadestaque')}}",
            data: { id: empresa, destaque_id: valor},
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
