<div class="row">
    <div class="col-lg-12">
        <div class="col-md-4">
            <div class="card">
                @if(isset($post->imagem1)!="")
                    <img class="card-img-top" src="{{ asset($post->imagem1) }}"  alt="Card image cap">
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Imagem destaque</h4>
                        <p class="card-text">{!! Form::file('imagem1', ['class' => 'form-control-file'])!!}</p>
                    </div>
                @else
                    <img class="card-img-top" src="{{ asset('public/images/700x400.png') }}"  alt="Card image cap">
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Imagem destaque</h4>
                        <p class="card-text">{!! Form::file('imagem1', ['class' => 'form-control-file', 'required' => 'required'])!!}</p>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                @if(isset($post->imagem2)!="")
                    <img class="card-img-top" src="{{ asset($post->imagem2) }}" alt="Card image cap">
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Imagem Blog</h4>
                        <p class="card-text">{!! Form::file('imagem2', ['class' => 'form-control-file'])!!}</p>
                    </div>
                @else
                    <img class="card-img-top" src="{{ asset('public/images/900x300.png') }}"  alt="Card image cap">
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Imagem Blog</h4>
                        <p class="card-text">{!! Form::file('imagem2', ['class' => 'form-control-file'])!!}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        {!! Form::label('titulo', 'Titulo*', ['class' => 'control-label']) !!}
        {!! Form::text('titulo', null, ['class' => 'form-control', 'required' => 'required']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('statu_id', 'Status*', ['class' => 'control-label']) !!}
        {!! Form::select('statu_id', $status, null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('situacao_id', 'Situações*', ['class' => 'control-label']) !!}
        {!! Form::select('situacao_id', $situacoes, null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-4">
        {!! Form::label('destaque_id', 'Destaque*', ['class' => 'control-label']) !!}
        {!! Form::select('destaque_id', $destaques, null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-12">
        <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
        {!! Form::label('descricao', 'Descrição*', ['class' => 'control-label']) !!}
        {!! Form::textarea('descricao', null,['class' => 'form-control my-editor', 'rows'=>20]) !!}
        <script>
            var editor_config = {
                path_absolute : "/oloyfit/public/",
                selector: "textarea.my-editor",
                plugins: [
                "advlist autolink lists link image  imagetools charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
            
                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }
            
                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
                }
            };
            
            tinymce.init(editor_config);
        </script>
    </div>
</div>


