{!! Form::hidden('redirect_to', URL::previous()) !!}
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="mx-auto d-block text-center">
            @if($usuario->foto=="")
                <img class="align-self-center rounded-circle mr-3" src="{{ asset('public/images/oloyfit-logo3.png') }}" style="width:137px; height:137px;"  alt="Card image cap">
            @else
                <img class="align-self-center rounded-circle mr-3" src="{{ asset($usuario->foto) }}" style="width:137px; height:137px;"  alt="Card image cap">
            @endif
            <hr>
            <div class="location text-sm-center">{!! Form::file('foto', ['class' => 'form-control-file'])!!}</div><br><br>
        </div>
    </div>
    <div class="col-md-4"></div>
    <div class="col-lg-6">
        {!! Form::label('name', 'Nome*', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-lg-6">
        {!! Form::label('email', 'E-mail*', ['class' => 'control-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('contato', 'Contato', ['class' => 'control-label']) !!}
        {!! Form::text('contato', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('sexo', 'Sexo', ['class' => 'control-label']) !!}
        {!! Form::select('sexo', ['' => 'Selecione aqui', '1' => 'Masculino', '2' => 'Femenino'], null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('aceitaCO', 'Receber conteudos e ofertas?', ['class' => 'control-label']) !!}
        {!! Form::select('aceitaCO', ['0' => 'Não', '1' => 'Sim'], null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('pais_id', 'Pais*', ['class' => 'control-label']) !!}
        {!! Form::select('pais_id', $paises, null, ['onchange' => 'pega_estados(this.value);pega_cidades()','class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-lg-4" id="carrega_estados">
        @if(isset($estados))
        {!! Form::label('estado_id', 'Estados*', ['class' => 'control-label']) !!}
        {!! Form::select('estado_id', $estados, null, ['onchange' => 'pega_cidades(this.value)','class' => 'form-control', 'required' => 'required']) !!}
        @else
        {!! Form::label('estado_id', 'Estados*', ['class' => 'control-label']) !!}
        {!! Form::select('estado_id', ['' => 'Selecione o Estado'], null, ['onchange' => 'pega_cidades(this.value)','class' => 'form-control', 'required' => 'required']) !!}
        @endif
    </div>
    <div class="col-lg-4" id="carrega_cidades">
        @if(isset($cidades))
        {!! Form::label('cidade_id', 'Cidades*', ['class' => 'control-label']) !!}
        {!! Form::select('cidade_id', $cidades, null, ['class' => 'form-control', 'required' => 'required']) !!}
        @else
        {!! Form::label('cidade_id', 'Cidades*', ['class' => 'control-label']) !!}
        {!! Form::select('cidade_id', ['' => 'Selecione a Cidade'], null, ['class' => 'form-control', 'required' => 'required']) !!}
        @endif
    </div>
</div>