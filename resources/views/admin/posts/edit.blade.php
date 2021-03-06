@extends('layouts.sufee')


@section('page_name', 'Editar')

@section('breadcrumbs', Breadcrumbs::render('admin.posts.edit', $post))

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
                        <strong class="card-title">Edite seus dados</strong>
                    </div>
                    {!! Form::model($post,['route' => ['admin.posts.update', 'id' => $post->id],'class' => 'form', 'method' => 'PUT', 'enctype'=>'multipart/form-data']) !!}
                    @include('admin.posts._form')
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
