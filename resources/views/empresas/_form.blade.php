{!! Form::hidden('redirect_to', URL::previous()) !!}
{!! Form::hidden('latitude', null, ['id' => "latitude"]) !!}
{!! Form::hidden('longitude', null, ['id' => "longitude"]) !!}
<div class="card-body">
    <div class="card-title">
        <h3 class="text-center">Perfil da Empresa</h3>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-12">
            <div class="col-md-6">
                <div class="card"  align="center">
                    <div class="imageBox">
                        <div class="thumbBox"></div>
                        <div class="spinner" style="display: none">Loading...</div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Imagem em destaque</h4>
                        <div class="action">
                            <p class="card-text">
                                @if(isset($empresa->imagem1)=="")
                                    {!! Form::file('imagem1', ['required' => 'required','style' => 'float:left;', 'id' => 'imagem1'])!!}
                                @else
                                    {!! Form::file('imagem1', ['style' => 'float:left;', 'id' => 'imagem1'])!!}
                                @endif 
                            </p>
                            <input name="imagem1_crop" id='imagem1_crop' type="hidden"/>
                            <input type="button" id="btnCrop1" value="Cortar" style="float: right">
                            <input type="button" id="btnZoomIn1" value="+" style="float: right">
                            <input type="button" id="btnZoomOut1" value="-" style="float: right">
                        </div>
                    </div>
                </div>
            </div>
            <div class="cropped1 col-md-6">
                
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col-md-6">
                <div class="card"  align="center">
                    <div class="imageBox2">
                        <div class="thumbBox2"></div>
                        <div class="spinner2" style="display: none">Loading...</div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Imagem 1 na descrição</h4>
                        <div class="action">
                            <p class="card-text">
                            @if(isset($empresa->imagem2)=="")
                                {!! Form::file('imagem2', ['required' => 'required', 'style' => 'float:left;', 'id' => 'imagem2'])!!}
                            @else
                                {!! Form::file('imagem2', ['style' => 'float:left;', 'id' => 'imagem2'])!!}
                            @endif 
                            </p>
                            <input name="imagem2_crop" id='imagem2_crop' type="hidden"/>
                            <input type="button" id="btnCrop2" value="Cortar" style="float: right">
                            <input type="button" id="btnZoomIn2" value="+" style="float: right">
                            <input type="button" id="btnZoomOut2" value="-" style="float: right">
                        </div>
                    </div>
                </div>
            </div>
            <div class="cropped2 col-md-6">
                
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col-md-6">
                <div class="card" align="center">
                    <div class="imageBox3">
                        <div class="thumbBox3"></div>
                        <div class="spinner3" style="display: none">Loading...</div>
                    </div>
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Imagem 2 na descrição</h4>
                        <div class="action">
                            <p class="card-text">
                            @if(isset($empresa->imagem3)=="")
                                {!! Form::file('imagem3', ['required' => 'required', 'style' => 'float:left;', 'id' => 'imagem3'])!!}
                            @else
                                {!! Form::file('imagem3', ['style' => 'float:left;', 'id' => 'imagem2'])!!}
                            @endif 
                            </p>
                            <input name="imagem3_crop" id='imagem3_crop' type="hidden"/>
                            <input type="button" id="btnCrop3" value="Cortar" style="float: right">
                            <input type="button" id="btnZoomIn3" value="+" style="float: right">
                            <input type="button" id="btnZoomOut3" value="-" style="float: right">
                        </div>
                    </div>
                </div>
            </div>
            <div class="cropped3 col-md-6">
                
            </div>
        </div>
        <div class="col-lg-4">
            {!! Form::label('name', 'Nome*', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-4">
            {!! Form::label('email', 'E-mail*', ['class' => 'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-4">
            {!! Form::label('contato', 'Contato*', ['class' => 'control-label']) !!}
            {!! Form::text('contato', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-12">
            {!! Form::label('descricao', 'Descrição*', ['class' => 'control-label']) !!}
            {!! Form::textarea('descricao', null, ['rows' => "3",'class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-4">
            {!! Form::label('endereco', 'Endereço*', ['class' => 'control-label']) !!}
            {!! Form::text('endereco', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-1">
            {!! Form::label('numero', 'Numero*', ['class' => 'control-label']) !!}
            {!! Form::text('numero', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-4">
            {!! Form::label('bairro', 'Bairro*', ['class' => 'control-label']) !!}
            {!! Form::text('bairro', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-3">
            {!! Form::label('complemento', 'Complemento', ['class' => 'control-label']) !!}
            {!! Form::text('complemento', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-6">
            {!! Form::label('site', 'Site', ['class' => 'control-label']) !!}
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
</div>

