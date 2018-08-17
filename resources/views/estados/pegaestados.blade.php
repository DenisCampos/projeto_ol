{!! Form::label('estado_id', 'Estados', ['class' => 'control-label']) !!}
{!! Form::select('estado_id', $estados, null, ['onchange' => 'pega_cidades(this.value)','class' => 'form-control']) !!}