@extends('layouts.site')

@section('content')

<div class="container">
    <!-- Page Heading/Breadcrumbs -->
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <br>
            {!! Form::model(compact('search'), ['class'=>'form-inline', 'method'=> 'GET'])!!}
            {!! Form::text('search', null, ['class' => 'form-control']) !!}
            {!! Form::submit('Pesquisar', array('class' => 'btn btn-custom')) !!}
            {!! Form::close()!!}
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12" role="group">
            <button type="button" class="mb-1 btn btn-outline-custom @if($categoria=='todos') active @endif" onclick="window.open('{{route('eventos.posts',['categoria'=>'todos'])}}','_self')">
                Todos
            </button>
            @foreach($vcategorias as $vcategoria)
            <button type="button" class="mb-1 btn btn-outline-custom @if($vcategoria->slug==$categoria) active @endif" onclick="window.open('{{route('eventos.posts',['categoria'=>$vcategoria->slug])}}','_self')">
                    {{$vcategoria->descricao}} 
            </button>
            @endforeach
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($eventos as $evento)
        <div class="col-lg-3 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="{{route('eventos.post',['evento'=>$evento->id])}}"><img class="card-img-top" src="{{asset($evento->imagem1)}}" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="{{route('eventos.post',['evento'=>$evento->id])}}">{{$evento->titulo}}</a>
                    </h5>
                    <p class="card-text text-center"><small>
                        Data: {{$evento->getData($evento->data_inicio) }}<br>
                        @if($evento->cidade_id!="" && $evento->estado_id!="")
                        Local: {{$evento->cidade->descricao}} -  {{$evento->estado->sigla}}
                        @endif
                    </small></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            {{ $eventos->links() }}
        </div>
    </div>
</div>
@endsection