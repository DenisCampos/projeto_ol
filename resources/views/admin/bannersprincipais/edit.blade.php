@extends('layouts.sufee')

@section('page_name', 'Editar')

@section('breadcrumbs', Breadcrumbs::render('admin.bannersprincipais.edit', $banner))

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
                        <strong class="card-title">Edite o Banner</strong>
                    </div>
                    {!! Form::model($banner,['route' => ['admin.bannersprincipais.update', 'id' => $banner->id],'class' => 'form', 'method' => 'PUT', 'enctype'=>'multipart/form-data']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Post</h3>
                        </div>
                        <hr>
                        @include('admin.bannersprincipais._form')
                    </div>
                    <div class="card-footer" align="center">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-block']) !!}                       
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
