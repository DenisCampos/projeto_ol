{!! Form::hidden('redirect_to', URL::previous()) !!}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if(isset($banner->banner)!="")
                <img class="card-img-top" src="{{ asset($banner->banner) }}"  alt="Card image cap">
                <div class="card-body">
                    <hr>
                    <h4 class="card-title mb-3">Imagem em destaque</h4>
                    <p class="card-text">{!! Form::file('banner', ['class' => 'form-control-file'])!!}</p>
                </div>
            @else
                <img class="card-img-top" src="{{ asset('public/images/400x100.png') }}"  alt="Card image cap">
                <div class="card-body">
                    <hr>
                    <h4 class="card-title mb-3">Imagem em destaque</h4>
                    <p class="card-text">{!! Form::file('banner', ['class' => 'form-control-file', 'required' => 'required'])!!}</p>
                </div>
            @endif
        </div>
    </div>
    @if(Auth::user()->tipo==1)
        <div class="col-lg-6">
            {!! Form::label('data_inicio', 'Inicio', ['class' => 'control-label']) !!}
            {!! Form::date('data_inicio', null, ['class' => 'form-control']) !!}<br>
        </div>
        <div class="col-lg-6">
            {!! Form::label('data_fim', 'Fim', ['class' => 'control-label']) !!}
            {!! Form::date('data_fim', null, ['class' => 'form-control']) !!}<br>
        </div>
        <div class="col-lg-6">
            {!! Form::label('statu_id', 'Status*', ['class' => 'control-label']) !!}
            {!! Form::select('statu_id', ['1' => 'Despublicado', '2' => 'Publicado'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-6">
            {!! Form::label('situacao_id', 'Situação*', ['class' => 'control-label']) !!}
            {!! Form::select('situacao_id', ['1' => 'Criado', '2' => 'Enviado', '3' => 'Aceito', '4' => 'Negado'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
    @endif
    <div class="col-lg-12">
        {!! Form::label('site', 'Link de redirecionamento', ['class' => 'control-label']) !!}   
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-laptop"></i></div>
            {!! Form::text('site', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>