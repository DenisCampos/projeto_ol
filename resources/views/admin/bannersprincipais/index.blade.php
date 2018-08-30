@extends('layouts.sufee')

@section('page_name', 'Banners Principais')

@section('breadcrumbs', Breadcrumbs::render('admin.bannersprincipais.index'))

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
                        <strong class="card-title">Banners cadastrados</strong>
                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Banners</h3>
                        </div>
                        <hr>
                        <div class="col-md-6 offset-md-3">
                            <div class="mx-auto d-block text-center">
                                <button type="button" class="btn btn-primary" onclick="window.location='{{ route("admin.bannersprincipais.create") }}'"><i class="fa fa-th"></i>&nbsp;Novo banner</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="bootstrap-data-table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Título</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
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
                                            @if(isset($banner->link))
                                            <a href="{{url($banner->link)}}" target="_blank">
                                                @if(isset($banner->titulo))
                                                {{$banner->titulo}}
                                                @endif
                                            </a>
                                            @elseif(isset($banner->titulo))
                                                {{$banner->titulo}}
                                            @endif
                                        </td>
                                        <td>{{$banner->statu->descricao}}</td>
                                        <td class="text-center"><button type="button" class="btn btn-warning" onclick="window.location='{{ route("admin.bannersprincipais.edit", ['id' => $banner->id]) }}'"><i class="fa fa-pencil-square-o"></i> Editar</button></td>
                                        <td class="text-center"><button type="button" class="btn btn-danger" onclick="window.location='{{ route("admin.bannersprincipais.destroy", ['id' => $banner->id]) }}'"><i class="fa fa-trash-o"></i> Excluir</button></td>
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
