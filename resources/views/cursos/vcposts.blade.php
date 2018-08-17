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
            <button type="button" class="mb-1 btn btn-outline-custom @if($categoria==0) active @endif" onclick="window.open('{{route('cursos.vcposts',['categoria'=>0])}}','_self')">
                Todos
            </button>
            @foreach($opcoescategorias as $opcoescategoria)
            <button type="button" class="mb-1 btn btn-outline-custom @if($opcoescategoria->id==$categoria) active @endif" onclick="window.open('{{route('cursos.vcposts',['categoria'=>$opcoescategoria->id])}}','_self')">
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
                <a href="{{route('cursos.post',['curso'=>$curso->id])}}"><img class="card-img-top" src="{{asset($curso->imagem1)}}" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="{{route('cursos.post',['curso'=>$curso->id])}}">{{$curso->titulo}}</a>
                    </h5>
                    @if($curso->sub_titulo!="")
                    <p class="card-text text-center"><small>{{$curso->sub_titulo}}</small></p>
                    @endif
                </div>
                <!--<div class="text-center mb-3">
                    <hr style="margin-top: 0px;">
                    <button type="buttom" onclick="window.open('{{route('cursos.post',['id'=>$curso->id])}}','_self')" class="btn btn-sm btn-custom">Saiba mais</button>
                </div>-->
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