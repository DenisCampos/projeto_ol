@extends('layouts.site')

@section('content')

<div class="container">
    <!-- Content Row -->
    <div class="row mt-4">
        <div class="col-lg-8 mb-4">
            <h5>Quem somos:</h5>
            <p>Somos um Portal que conecta pessoas que buscam um estilo de vida saudável aos profissionais e empresas do segmento fitness, oferecendo conteúdos de valor e informações de produtos e serviços de alta performance que irão potencializar seus resultados.</p>
            <hr>
            <h5>Missão:</h5>
            <p>Impactar e transformar o maior número de pessoas através da consolidação da cultura de vida saudável em nosso país, oferecendo a melhor experiência na busca por conteúdos, produtos e serviços fitness de qualidade na internet.</p>
            <hr>
            <h5>Visão:</h5>
            <p>Ser referência nacional como o maior portal de conteúdo fitness e vida saudável até 2020.</p>
            <hr>
            <h5>Valores:</h5>
            <p>Vida saudável, Conhecimento, Informação, Resultados, Ética e Transparência.</p>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4">
            <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Top Produtos 
                        <button type="buttom" onclick="window.open('{{route('cursos.posts',['categoria'=>0])}}','_self')" class="btn btn-sm btn-custom pull-right">Todos</button>
                    </h5>
                    <hr>
                </div>
                @foreach($cursos as $curso)
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3">
                        <a href="{{route('cursos.post',['post'=>$curso->id])}}">
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