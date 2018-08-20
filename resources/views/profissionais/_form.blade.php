{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Form::hidden('latitude', null, ['id' => "latitude"]) !!}
{!! Form::hidden('longitude', null, ['id' => "longitude"]) !!}
<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-5">
        <div class="card" align="center">
            <div class="imageBoxProf">
                <div class="thumbBoxProf"></div>
                <div class="spinnerProf" style="display: none">Loading...</div>
            </div>
            <div class="card-body">
                <hr>
                <h4 class="card-title mb-3">Imagem em destaque</h4>
                <div class="action">
                    <p class="card-text">
                        @if(isset($profissional->foto)=="")
                            {!! Form::file('foto', ['required' => 'required','style' => 'float:left;', 'id' => 'foto'])!!}
                        @else
                            {!! Form::file('foto', ['style' => 'float:left;', 'id' => 'foto'])!!}
                        @endif 
                    </p>
                    <input name="foto_crop" id='foto_crop' type="hidden"/>
                    <input type="button" id="btnCropProf" value="Cortar" style="float: right">
                    <input type="button" id="btnZoomInProf" value="+" style="float: right">
                    <input type="button" id="btnZoomOutProf" value="-" style="float: right">
                </div>
            </div>
        </div>
    </div>
    <div class="croppedProf col-md-5"></div>
    <div class="col-md-1"></div>
    <div class="col-lg-4">
        {!! Form::label('name', 'Nome*', ['class' => 'control-label']) !!}
        {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('email', 'E-mail*', ['class' => 'control-label']) !!}
        {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('contato', 'Contato', ['class' => 'control-label']) !!}
        {!! Form::text('contato', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-12">
        {!! Form::label('descricao', 'Descrição*', ['class' => 'control-label']) !!}
        {!! Form::textarea('descricao', null, ['rows' => "3",'class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('endereco', 'Endereço', ['class' => 'control-label']) !!}
        {!! Form::text('endereco', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-1">
        {!! Form::label('numero', 'Numero', ['class' => 'control-label']) !!}
        {!! Form::text('numero', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('bairro', 'Bairro', ['class' => 'control-label']) !!}
        {!! Form::text('bairro', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-3">
        {!! Form::label('complemento', 'Complemento', ['class' => 'control-label']) !!}
        {!! Form::text('complemento', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-12">
            {!! Form::label('site', 'site', ['class' => 'control-label']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-laptop"></i></div>
                {!! Form::text('site', null, ['class' => 'form-control']) !!}
            </div>
        </div>
    <div class="col-lg-6">
        {!! Form::label('facebook', 'Facebook', ['class' => 'control-label']) !!}
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
            {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        {!! Form::label('twitter', 'Twitter', ['class' => 'control-label']) !!}
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
            {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        {!! Form::label('instagram', 'Instagram', ['class' => 'control-label']) !!}
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-instagram"></i></div>
            {!! Form::text('instagram', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-6">
        {!! Form::label('linkedin', 'LinkedIn', ['class' => 'control-label']) !!}
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-linkedin"></i></div>
            {!! Form::text('linkedin', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-lg-4">
        {!! Form::label('pais_id', 'Pais', ['class' => 'control-label']) !!}
        {!! Form::select('pais_id', $paises, null, ['onchange' => 'pega_estados(this.value);pega_cidades()','class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4" id="carrega_estados">
        @if(isset($estados))
        {!! Form::label('estado_id', 'Estados', ['class' => 'control-label']) !!}
        {!! Form::select('estado_id', $estados, null, ['onchange' => 'pega_cidades(this.value)','class' => 'form-control']) !!}
        @else
        {!! Form::label('estado_id', 'Estados', ['class' => 'control-label']) !!}
        {!! Form::select('estado_id', ['' => 'Selecione o Estado'], null, ['onchange' => 'pega_cidades(this.value)','class' => 'form-control']) !!}
        @endif
    </div>
    <div class="col-lg-4" id="carrega_cidades">
        @if(isset($cidades))
        {!! Form::label('cidade_id', 'Cidades', ['class' => 'control-label']) !!}
        {!! Form::select('cidade_id', $cidades, null, ['class' => 'form-control']) !!}
        @else
        {!! Form::label('cidade_id', 'Cidades', ['class' => 'control-label']) !!}
        {!! Form::select('cidade_id', ['' => 'Selecione a Cidade'], null, ['class' => 'form-control']) !!}
        @endif
    </div>
    <div class="col-lg-12 mb-2 mt-2">
        {!! Form::label('map', 'Clique no mapa para adicionar sua localização', ['class' => 'control-label']) !!} ou <input type="button" id="buscar" name="buscar" class="btn btn-primary btn-sm" value="Procure endereço/bairro cadastrados" > 
    </div>
    <div class="col-lg-12" style="height:400px" id="map"></div>
</div>