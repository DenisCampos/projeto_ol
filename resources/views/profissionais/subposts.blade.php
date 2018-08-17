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
    <div class="row mb-3">
        <div class="col-lg-12" role="group">
            <button type="button" class="mb-1 btn btn-outline-custom @if($atuacao==0) active @endif" onclick="window.open('{{route('profissionais.posts',['atuacao'=>0])}}','_self')">
                Todos
            </button>
            @foreach($patuacoes as $patuacao)
                @php
                    $possui=false;
                @endphp
                @foreach($psubatuacoes as $psubatuacao)
                    @php
                    if($patuacao->id==$psubatuacao->atuacao_id){
                        $possui=true;
                        break;
                    }
                    @endphp
                @endforeach
                @if($possui==true)
                    <button type="button" class="mb-1 btn btn-outline-custom @if($patuacao->id==$atuacao) active @endif" onclick="window.open('{{route('profissionais.subposts',['atuacao'=>$patuacao->id,'subatuacao'=>0])}}','_self')">
                        {{$patuacao->descricao}} 
                    </button>
                @else
                    <button type="button" class="mb-1 btn btn-outline-custom @if($patuacao->id==$atuacao) active @endif" onclick="window.open('{{route('profissionais.posts',['atuacao'=>$patuacao->id])}}','_self')">
                        {{$patuacao->descricao}} 
                    </button>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" role="group">
            <button type="button" class="mb-1 btn btn-outline-subcustom @if($subatuacao==0) active @endif" onclick="window.open('{{route('profissionais.subposts',['atuacao'=>$atuacao,'subatuacao'=>0])}}','_self')">
                Todos
            </button>
            @foreach($opcoessubatuacoes as $opcoessubatuacao)
            <button type="button" class="mb-1 btn btn-outline-subcustom @if($opcoessubatuacao->id==$subatuacao) active @endif" onclick="window.open('{{route('profissionais.subposts',['atuacao'=>$atuacao,'subatuacao'=>$opcoessubatuacao->id])}}','_self')">
                {{$opcoessubatuacao->descricao}} 
            </button>
            @endforeach
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($profissionais as $profissional)
        <div class="col-lg-3 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="{{route('profissionais.post',['profissional'=>$profissional->id])}}"><img class="card-img-top" src="{{asset($profissional->foto)}}" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="{{route('profissionais.post',['profissional'=>$profissional->id])}}">{{$profissional->name}}</a>
                    </h5>
                    <p class="text-center"><small>
                        @foreach($profatuacoes_array as $profatuacoes)
                            @if($profatuacoes[0]->profissional_id == $profissional->id)
                                @php
                                    $cont = 0;
                                @endphp
                                @foreach($profatuacoes as $profatuacao)
                                    @if($cont==0)
                                        {{$profatuacao->descricao}}
                                        @php
                                            $cont++;
                                        @endphp
                                    @else
                                        / {{$profatuacao->descricao}}
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
            {{ $profissionais->links() }}
        </div>
    </div>
</div>
@endsection