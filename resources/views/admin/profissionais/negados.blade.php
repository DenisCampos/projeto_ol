@extends('layouts.sufee')

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Profissionais</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li class="active">Profissionais</li>
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
                        <strong class="card-title">Profissões dos usuários</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Perfil Profissional Negados</h3>
                        </div>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="bootstrap-data-table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Situação</th>
                                    <th scope="col" class="text-center" width="8%"></th>
                                    <th scope="col" class="text-center" width="8%"></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont=1;
                                    @endphp
                                    @foreach($profissionais as $profissional)
                                    <tr>
                                        <td>{{$cont}}</td>
                                        <td>
                                            @if($profissional->foto!="")
                                            <img class="user-avatar rounded-circle" src="{{ asset($profissional->foto)}}" style="width:32px; height:32px;">
                                            @else
                                            <img class="user-avatar rounded-circle" src="{{ asset('public/images/oloyfit-logo3.png') }}" style="width:32px; height:32px;">
                                            @endif
                                            {{$profissional->name}}
                                        </td>
                                        <td>{{$profissional->statu->descricao}}</td>
                                        <td>{{$profissional->situacao->descricao}}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-secondary" onclick="window.location='{{ route("admin.profissionalbanners.bannerprofs", ['profissional' => $profissional->id]) }}'">
                                                <i class="fa fa-picture-o"></i> Ver Banners
                                            </button>
                                        </td>
                                        <td class="text-center"><button type="button" class="btn btn-info" onclick="window.location='{{ route("admin.profissionais.adminshow", ['id' => $profissional->id]) }}'"><i class="fa fa-file-text-o"></i> Detalhar</button></td>
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
<script>
    $(document).ready(function() {
       $('#bootstrap-data-table-export').DataTable();
   } );
</script>

@endsection
