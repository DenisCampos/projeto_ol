@extends('layouts.site')

@section('content')

<div class="container">
    <!-- Content Row -->
    <div class="row mt-4">
        <div class="col-lg-8 mb-4">
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
        {!! Form::open(['route' => ['mails.faleconosco'],'class' => 'form', 'method' => 'POST']) !!}
            <div class="control-group form-group">
            <div class="controls">
                <label>Nome completo:</label>
                <input type="text" class="form-control" id="name" name="name" required>
                <p class="help-block"></p>
            </div>
            </div>
            <div class="control-group form-group">
            <div class="controls">
                <label>Telefone:</label>
                <input type="text" class="form-control" id="tel" name="tel">
            </div>
            </div>
            <div class="control-group form-group">
            <div class="controls">
                <label>Email:</label>
                <input type="email" class="form-control" id="cemail" name="cemail" required>
            </div>
            </div>
            <div class="control-group form-group">
            <div class="controls">
                <label>Mensagem:</label>
                <textarea rows="10" cols="100" class="form-control" id="mensagem" name="mensagem" required maxlength="999" style="resize:none"></textarea>
            </div>
            </div>
            <div id="success"></div>
            <!-- For success/fail messages -->
            <button type="submit" class="btn btn-custom">Enviar</button>
        {!! Form::close() !!}
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4">
            <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Top Produtos 
                        <button type="buttom" onclick="window.open('{{route('cursos.posts',['categoria'=>'todos'])}}','_self')" class="btn btn-sm btn-custom pull-right">Todos</button>
                    </h5>
                    <hr>
                </div>
                @foreach($cursos as $curso)
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3">
                        <a href="{{route('cursos.post',['post'=>$curso->slug])}}">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="{{asset($curso->imagem1)}}" alt="">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h5 class="text-custom-titulo">{{$curso->titulo}}</h5>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
@endsection
