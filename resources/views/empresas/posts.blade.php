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
            <button type="button" class="mb-1 btn btn-outline-custom @if($atuacao==0) active @endif" onclick="window.open('{{route('empresas.posts',['atuacao'=>0])}}','_self')">
                Todos
            </button>
            @foreach($eatuacoes as $eatuacao)
                @php
                    $possui=false;
                @endphp
                @foreach($esubatuacoes as $esubatuacao)
                    @php
                    if($eatuacao->id==$esubatuacao->atuacao_id){
                        $possui=true;
                        break;
                    }
                    @endphp
                @endforeach
                @if($possui==true)
                    <button type="button" class="mb-1 btn btn-outline-custom @if($eatuacao->id==$atuacao) active @endif" onclick="window.open('{{route('empresas.subposts',['atuacao'=>$eatuacao->id,'subatuacao'=>0])}}','_self')">
                        {{$eatuacao->descricao}} 
                    </button>
                @else
                    <button type="button" class="mb-1 btn btn-outline-custom @if($eatuacao->id==$atuacao) active @endif" onclick="window.open('{{route('empresas.posts',['atuacao'=>$eatuacao->id])}}','_self')">
                        {{$eatuacao->descricao}} 
                    </button>
                @endif
            @endforeach
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($empresas as $empresa)
        <div class="col-lg-3 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="{{route('empresas.post',['empresa'=>$empresa->id])}}"><img class="card-img-top" src="{{asset($empresa->imagem1)}}" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="{{route('empresas.post',['empresa'=>$empresa->id])}}">{{$empresa->name}}</a>
                    </h5>
                    <p class="text-center"><small>
                        @foreach($empatuacoes_array as $empatuacoes)
                            @if($empatuacoes[0]->empresa_id == $empresa->id)
                                @php
                                    $cont = 0;
                                @endphp
                                @foreach($empatuacoes as $empatuacao)
                                    @if($cont==0)
                                        {{$empatuacao->descricao}}
                                        @php
                                            $cont++;
                                        @endphp
                                    @else
                                        / {{$empatuacao->descricao}}
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </small></p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            {{ $empresas->links() }}
        </div>
    </div>
</div>
@endsection