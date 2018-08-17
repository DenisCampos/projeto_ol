@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Banners</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{route('admin.usuarios.index')}}">Usuários</a></li>
                    <li><a href="{{route('admin.usuarios.edit',['usuario'=>$profissional->user_id])}}">Detalhar</a></li>
                    <li><a href="{{route('admin.profissionais.userprofs',['usuario' => $profissional->user_id])}}">Profissões</a></li>
                    <li class="active">Banners</li>
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
                    <strong class="card-title">Banners do profissional {{$profissional->name}}</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Banners</h3>
                        </div>
                        <hr>
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
                                    <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("admin.profissionalbanners.adminshow", ['profissional' => $profissional->id, 'id' => $banner->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
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
    function liberar_banner(profissional) {
        
        var classe = document.getElementById('banner'+profissional).getAttribute('class');
        var valor;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById('banner'+profissional).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById('banner'+profissional).setAttribute('style', 'color:#d9534f');
            valor = 0;
        }else{
            document.getElementById('banner'+profissional).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById('banner'+profissional).setAttribute('style', 'color:#5cb85c');
            valor = 1;
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('admin.profissionais.liberabanner')}}",
            data: { id: profissional, banner: valor},
            dataType: 'json',
            success: function (res)
            {  
                if(res)
                {
                                            
                }
            }
        });	
    };

     function liberar_destaque(profissional) {
        
        var classe = document.getElementById('destaque'+profissional).getAttribute('class');
        var acao, valor;
        
        if (classe == 'fa fa-toggle-on fa-2x'){
            document.getElementById('destaque'+profissional).setAttribute('class', 'fa fa-toggle-off fa-2x');
            document.getElementById('destaque'+profissional).setAttribute('style', 'color:#d9534f');
            valor = 1;
        }else{
            document.getElementById('destaque'+profissional).setAttribute('class', 'fa fa-toggle-on fa-2x');
            document.getElementById('destaque'+profissional).setAttribute('style', 'color:#5cb85c');
            valor = 2;
        }

        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('admin.profissionais.liberadestaque')}}",
            data: { id: profissional, destaque_id: valor},
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
