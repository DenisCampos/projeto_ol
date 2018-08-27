{!! Form::hidden('redirect_to', URL::previous()) !!}
<div class="card-body">
    <div class="card-title">
        <h3 class="text-center">Infoprodutos</h3>
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
                                @if(isset($curso->imagem1)=="")
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
                        <h4 class="card-title mb-3">Imagem em destaque</h4>
                        <div class="action">
                            <p class="card-text">
                            @if(isset($curso->imagem2)=="")
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
            {!! Form::label('titulo', 'Titulo*', ['class' => 'control-label']) !!}
            {!! Form::text('titulo', null, ['class' => 'form-control', 'required' => 'required']) !!}
        </div>
        <div class="col-lg-12">
            {!! Form::label('sub_titulo', 'Sub-Titulo', ['class' => 'control-label']) !!}
            {!! Form::text('sub_titulo', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-12">
            <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
            {!! Form::label('descricao', 'Descrição*', ['class' => 'control-label']) !!}
            {!! Form::textarea('descricao', null,['class' => 'form-control my-editor', 'rows'=>10]) !!}
            <script>
                var editor_config = {
                    path_absolute : "/oloyfit/public/",
                    selector: "textarea.my-editor",
                    plugins: [
                    "advlist autolink lists charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars code fullscreen",
                    "insertdatetime nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |",
                    relative_urls: false,
                    file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                   
                    }
                };
                
                tinymce.init(editor_config);
            </script>
        </div>
        <div class="col-lg-3">
            {!! Form::label('data_inicio', 'Inicio', ['class' => 'control-label']) !!}
            {!! Form::datetimelocal('data_inicio', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-3">
            {!! Form::label('data_fim', 'Fim', ['class' => 'control-label']) !!}
            {!! Form::datetimelocal('data_fim', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-3">
            {!! Form::label('contato', 'Contato', ['class' => 'control-label']) !!}
            {!! Form::text('contato', null, ['class' => 'form-control']) !!}
        </div>
        <div class="col-lg-3">
            {!! Form::label('investimento', 'Investimento', ['class' => 'control-label']) !!}
            {!! Form::text('investimento', null, ['class' => 'form-control']) !!}
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
        <div class="col-lg-4">
            {!! Form::label('link', 'Link para compra', ['class' => 'control-label']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-shopping-cart"></i></div>
                {!! Form::text('link', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-4">
            {!! Form::label('site', 'Site', ['class' => 'control-label']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-laptop"></i></div>
                {!! Form::text('site', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-4">
            {!! Form::label('facebook', 'Facebook', ['class' => 'control-label']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-4">
            {!! Form::label('twitter', 'Twitter', ['class' => 'control-label']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-4">
            {!! Form::label('instagram', 'Instagram', ['class' => 'control-label']) !!}
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-instagram"></i></div>
                {!! Form::text('instagram', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-4">
             
        </div>
        <div class="col-lg-4">
            {!! Form::label('pais_id', 'Pais', ['class' => 'control-label', 'required' => 'required']) !!}
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
    </div>
</div>

