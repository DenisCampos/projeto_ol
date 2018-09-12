@extends('layouts.site')

@section('assets_meta')
    <meta property='og:title' content='{{$post->titulo}}' />
    <meta property='og:description' content='{!!$post->descricao!!}' />
    <meta property='og:image' itemprop="image" content='{{ asset($post->imagem1) }}' />
    <meta property='og:type' content='website' />
    <meta property='article:author' content='https://www.facebook.com/oloyfit' />
    <meta property='og:site_name' content='OloyFit' />
    <meta name='twitter:card' content='summary_large_image' />
    <meta name='twitter:title' content='{{$post->titulo}}' />
    <meta name='twitter:description' content='{!!$post->descricao!!}' />
    <meta name='twitter:image:src' content='{{ asset($post->imagem1) }}' />
@endsection

@section('titulo')
    {{$post->titulo}}
@endsection

@section('descricao')
    InfoProduto OloyFit: {{$post->titulo}}
@endsection

@section('content')

<div class="container">
    <br>
    <!-- Intro Content -->
    <div class="row mb-2">
        <div class="col-lg-12 text-custom-titulo"><h3>{{$post->titulo}}</h3><hr></div>
        <div class="col-lg-8">
             @if($post->imagem2!="")
            <img class="img-fluid rounded" src="{{ asset($post->imagem2) }}" alt="">
            <hr>
            @endif

             <!-- Date/Time -->
            <small>Postado em {{ $post->created_at->format('d M Y - H:i:s') }}</small>

            <hr>

            <p>{!!$post->descricao!!}</p>
            <div id="share" class="mb-3"></div>
        </div>
        <div class="col-lg-4">
            <div class="container row mb-5">
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
            <div class="container row">
                <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Profissionais</h5>
                    <hr>
                </div>
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
                    <div class="col-md-12">
                        <a href="{{route('profissionais.subposts',['atuacao'=>$patuacao->slug,'subatuacao'=>'todos'])}}">
                            {{$patuacao->descricao}}
                        </a>
                    </div>
                    @else
                        <div class="col-md-12">
                            <a  href="{{route('profissionais.posts',['atuacao'=>$patuacao->slug])}}">
                                {{$patuacao->descricao}}
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-lg-12">
            @if(count($posts)>0)
            <hr>
            <!-- Our Customers -->
            <h3 class="text-custom-titulo">Outros artigos</h3>
            <div class="row">
                @foreach($posts as $post)
                <div class="col-lg-3 col-sm-6 portfolio-item">
                    <div class="card h-100">
                        <a href="{{route('blog.post',['post'=>$post->slug])}}"><img class="card-img-top" src="{{asset($post->imagem1)}}" alt=""></a>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{route('blog.post',['post'=>$post->slug])}}">{{$post->titulo}}</a>
                            </h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- /.row -->
            @endif
        </div>
    </div>
    <!-- /.row -->
</div>

@endsection

@section('assets_scripts')
<script>
    $("#share").jsSocials({
        shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "whatsapp"]
    });
</script>

@endsection