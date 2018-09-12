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
            <button type="button" class="mb-1 btn btn-outline-custom @if($atuacao=='todos') active @endif" onclick="window.open('{{route('profissionais.posts',['atuacao'=>'todos'])}}','_self')">
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
                    <button type="button" class="mb-1 btn btn-outline-custom @if($patuacao->slug==$atuacao) active @endif" onclick="window.open('{{route('profissionais.subposts',['atuacao'=>$patuacao->slug,'subatuacao'=>'todos'])}}','_self')">
                        {{$patuacao->descricao}} 
                    </button>
                @else
                    <button type="button" class="mb-1 btn btn-outline-custom @if($patuacao->slug==$atuacao) active @endif" onclick="window.open('{{route('profissionais.posts',['atuacao'=>$patuacao->slug])}}','_self')">
                        {{$patuacao->descricao}} 
                    </button>
                @endif
            @endforeach
        </div>
    </div>
    <br>
    <div class="row">
        @foreach($profissionais as $profissional)
        <div class="col-lg-3 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="{{route('profissionais.post',['profissional'=>$profissional->slug])}}"><img class="card-img-top" src="{{asset($profissional->foto)}}" alt=""></a>
                <div class="card-body">
                    <h5 class="card-title text-center">
                        <a href="{{route('profissionais.post',['profissional'=>$profissional->slug])}}">{{$profissional->name}}</a>
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