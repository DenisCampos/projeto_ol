@extends('layouts.sufee')

@section('page_name', 'Editar')

@section('breadcrumbs', Breadcrumbs::render('cursos.edit', $curso))

@section('assets_css')
<link rel="stylesheet" href="{{ asset('public/css/custom-sistema.css') }}" type="text/css" />
@endsection

@section('content')

<div class="content mt-3">
    @if(Session::has('message'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Sucesso</span>  {!! Session::get('message') !!}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        </div>
    </div>
    @endif
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Edite seus dados</strong>
                    </div>
                    {!! Form::model($curso,['route' => ['cursos.update', 'id' => $curso->id],'class' => 'form', 'method' => 'PUT', 'enctype'=>'multipart/form-data']) !!}
                    @include('cursos._form')
                    <div class="card-footer" align="center">
                        {!! Form::submit('Salvar', ['class' => 'btn btn-primary btn-block']) !!}                       
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('assets_scripts')
<script src="{{ asset('public/js/cropbox.js') }}"></script>
<script type="text/javascript">
    window.onload = function() {
        var options1 =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            @if($curso->imagem1=="")
                imgSrc: '{{ asset("public/images/700x400.png") }}'
            @else
                imgSrc: '{{ asset($curso->imagem1) }}'
            @endif
        }
        var cropper1 = new cropbox(options1);
        document.querySelector('#imagem1').addEventListener('change', function(){
            var reader1 = new FileReader();
            reader1.onload = function(e) {
                options1.imgSrc = e.target.result;
                cropper1 = new cropbox(options1);
            }
            reader1.readAsDataURL(this.files[0]);
            setTimeout(function(){ autocrop(cropper1, '1'); }, 300);
            this.files = [];
        })
        document.querySelector('#btnCrop1').addEventListener('click', function(){
            var img1 = cropper1.getDataURL();
            document.querySelector('.cropped1').innerHTML = '<img src="'+img1+'">';
            $("#imagem1_crop").val(img1);
        })
        document.querySelector('#btnZoomIn1').addEventListener('click', function(){
            cropper1.zoomIn();
        })
        document.querySelector('#btnZoomOut1').addEventListener('click', function(){
            cropper1.zoomOut();
        })

         var options2 =
        {
            imageBox: '.imageBox2',
            thumbBox: '.thumbBox2',
            spinner: '.spinner2',
            @if($curso->imagem2=="")
                imgSrc: '{{ asset("public/images/700x400.png") }}'
            @else
                imgSrc: '{{ asset($curso->imagem2) }}'
            @endif
        }
        var cropper2 = new cropbox(options2);
        document.querySelector('#imagem2').addEventListener('change', function(){
            var reader2 = new FileReader();
            reader2.onload = function(e) {
                options2.imgSrc = e.target.result;
                cropper2 = new cropbox(options2);
            }
            reader2.readAsDataURL(this.files[0]);
            setTimeout(function(){ autocrop(cropper2, '2'); }, 300);
            this.files = [];
        })
        document.querySelector('#btnCrop2').addEventListener('click', function(){
            var img2 = cropper2.getDataURL();
            document.querySelector('.cropped2').innerHTML = '<img src="'+img2+'">';
            $("#imagem2_crop").val(img2);
        })
        document.querySelector('#btnZoomIn2').addEventListener('click', function(){
            cropper2.zoomIn();
        })
        document.querySelector('#btnZoomOut2').addEventListener('click', function(){
            cropper2.zoomOut();
        })
    };

    function autocrop(cropper, id){
        var img = cropper.getDataURL();
        document.querySelector('.cropped'+id).innerHTML = '<img src="'+img+'">';
        $("#imagem"+id+"_crop").val(img);
    }

     function pega_estados(pais) {
        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('estados.pegaestados')}}",
            data: {id: pais},
            success: function (res)
            {  
                if(res)
                {
                    $('#carrega_estados').html(res);
                }
            }
        });	
    };
    
    function pega_cidades(estado) {
        jQuery.ajax({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type:"POST",
            url: "{{route('cidades.pegacidades')}}",
            data: {id: estado},
            success: function (res)
            {  
                if(res)
                {
                    $('#carrega_cidades').html(res);
                }
            }
        });	
    };
</script>
@endsection
