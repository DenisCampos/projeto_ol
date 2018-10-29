@extends('layouts.sufee')

@section('assets_css')
<link rel="stylesheet" href="{{ asset('public/css/custom-sistema.css') }}" type="text/css" />
@endsection

@section('page_name', 'Novo')

@section('breadcrumbs', Breadcrumbs::render('admin.empresas.admincreate', $usuario))

@section('content')

<div class="content mt-3">
    @if(Session::has('message'))
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                <span class="badge badge-pill badge-success">Sucesso</span>  {!! Session::get('message') !!}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
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
                    {!! Form::model($usuario,['route' => ['admin.empresas.adminstore', 'id' => $usuario->id],'class' => 'form', 'method' => 'POST', 'enctype'=>'multipart/form-data']) !!}
                    <div class="card-body">
                        @include('empresas._form')
                    </div>
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
@section('assets_scripts')
<script src="{{ asset('public/js/cropbox.js') }}"></script>
<script type="text/javascript">
    window.onload = function() {
        var options1 =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            imgSrc: '{{ asset("public/images/700x400.png") }}'
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
            imgSrc: '{{ asset("public/images/700x400.png") }}'
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

        var options3 =
        {
            imageBox: '.imageBox3',
            thumbBox: '.thumbBox3',
            spinner: '.spinner3',
            imgSrc: '{{ asset("public/images/700x400.png") }}'
        }
        var cropper3 = new cropbox(options3);
        document.querySelector('#imagem3').addEventListener('change', function(){
            var reader3 = new FileReader();
            reader3.onload = function(e) {
                options3.imgSrc = e.target.result;
                cropper3 = new cropbox(options3);
            }
            reader3.readAsDataURL(this.files[0]);
            setTimeout(function(){ autocrop(cropper3, '3'); }, 300);
            this.files = [];
        })
        document.querySelector('#btnCrop3').addEventListener('click', function(){
            var img3 = cropper3.getDataURL();
            document.querySelector('.cropped3').innerHTML = '<img src="'+img3+'">';
            $("#imagem3_crop").val(img3);
        })
        document.querySelector('#btnZoomIn3').addEventListener('click', function(){
            cropper3.zoomIn();
        })
        document.querySelector('#btnZoomOut3').addEventListener('click', function(){
            cropper3.zoomOut();
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

    function initMap() {

        var myLatLng = {lat: -2.5680909, lng: -44.3812118};
        var count_marker = 0;

        var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 14,
        center: myLatLng
        });

        var geocoder = new google.maps.Geocoder();

        document.getElementById('buscar').addEventListener('click', function() {
            geocodeAddress(geocoder, map);
        });


        // This event listener will call addMarker() when the map is clicked.
        map.addListener('click', function(event) {
            addMarker(event.latLng);
        });

        function geocodeAddress(geocoder, resultsMap) {
            var endereco = document.getElementById('endereco').value;
            var bairro = document.getElementById('bairro').value;
            var address = endereco+' '+bairro;
            geocoder.geocode({'address': address}, function(results, status) {
            if (status === 'OK') {
                resultsMap.setCenter(results[0].geometry.location);
                map.setZoom(18);
            } else {
                alert('Endereço não encontrado: ' + status);
            }
            });
        }

        function addMarker(location) {
            if(count_marker==0){
                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    id: 1
                });

                marker.addListener('click', function() {
                    removerMarkers(marker);
                });
                $("#latitude").val(location.lat());
                $("#longitude").val(location.lng());
                count_marker++;
            }else{
                alert("Exclua a localização anterior");
            }
        }

        function removerMarkers(marker){
            var r = confirm("Deseja Remover?");
            var x;
            if (r == true) {
                marker.setMap(null);
                $("#latitude").val('');
                $("#longitude").val('');
                count_marker=0;
            } 
            
        }

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                map.setCenter(pos);
                map.setZoom(20);
            });
        } 
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2UTdk-E7kWhTX-YUDQXUVc5FnQiaYIuA&callback=initMap" type="text/javascript"></script>

@endsection