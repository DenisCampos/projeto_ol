<button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-bell"></i>
    <span class="count bg-danger">{{$avisoscount}}</span>
</button>
<div class="dropdown-menu" aria-labelledby="notification">
    @foreach($avisos as $aviso)
        @if($aviso->visualizou==0)
            @if($aviso->situacao_id==1 || $aviso->situacao_id==2)
                <a class="dropdown-item media bg-flat-color-3" href="{{route('pareceres.show',['id'=>$aviso->id])}}">
            @elseif($aviso->situacao_id==3)
                <a class="dropdown-item media bg-flat-color-5" href="{{route('pareceres.show',['id'=>$aviso->id])}}">
            @elseif($aviso->situacao_id==4)
                <a class="dropdown-item media bg-flat-color-4" href="{{route('pareceres.show',['id'=>$aviso->id])}}">
            @endif
        @else
            <a class="dropdown-item media bg-flat-color-0" href="{{route('pareceres.show',['id'=>$aviso->id])}}">
        @endif

        @if($aviso->situacao_id==1)
            <i class="fa fa-check"></i>
        @elseif($aviso->situacao_id==2)
            <i class="fa fa-mail-forward"></i>
        @elseif($aviso->situacao_id==3)
            <i class="fa fa-check"></i>
        @elseif($aviso->situacao_id==4)
            <i class="fa fa-ban"></i>
        @endif

        @if($aviso->tipo==1)
            <p>{{$aviso->profissional->name}}</p>
        @elseif($aviso->tipo==2)
            <p>{{$aviso->empresa->name}}</p>
        @elseif($aviso->tipo==3)
            <p>{{$aviso->curso->titulo}}</p>
        @elseif($aviso->tipo==4)
            <p>{{$aviso->evento->titulo}}</p>
        @elseif($aviso->tipo==5)
            <p>{{$aviso->bannerprof->profissional->name}}</p>
        @elseif($aviso->tipo==6)
            <p>{{$aviso->banneremp->empresa->name}}</p>
        @endif
    </a>
    @endforeach
    <a href="{{route('pareceres.showall')}}">
        <p class="red">Ver todos</p>
    </a>
</div>