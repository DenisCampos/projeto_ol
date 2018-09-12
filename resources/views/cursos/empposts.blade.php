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
            <button type="button" class="mb-1 btn btn-outline-custom @if($categoria=='todos') active @endif" onclick="window.open('{{route('cursos.empposts',['categoria'=>'todos'])}}','_self')">
                Todos
            </button>
            @foreach($opcoescategorias as $opcoescategoria)
            <button type="button" class="mb-1 btn btn-outline-custom @if($opcoescategoria->slug==$categoria) active @endif" onclick="window.open('{{route('cursos.empposts',['categoria'=>$opcoescategoria->slug])}}','_self')">
                    {{$opcoescategoria->descricao}} 
            </button>
            @endforeach
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($cursos as $curso)
        <div class="col-lg-3 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="{{route('cursos.post',['curso'=>$curso->slug])}}"><img class="card-img-top" src="{{asset($curso->imagem1)}}" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="{{route('cursos.post',['curso'=>$curso->slug])}}">{{$curso->titulo}}</a>
                    </h5>
                    @if($curso->sub_titulo!="")
                    <p class="card-text text-center"><small>{{$curso->sub_titulo}}</small></p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            {{ $cursos->links() }}
        </div>
    </div>
</div>
@endsection