@extends('layouts.sufee')

@section('assets_css')
<link rel="stylesheet" href="{{ asset('public/css/custom-sistema.css') }}" type="text/css" />
@endsection

@section('page_name',  'Editar')

@section('breadcrumbs', Breadcrumbs::render('admin.profissionais.adminedit', $usuario, $profissional))

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
                    {!! Form::model($profissional,['route' => ['admin.profissionais.adminupdate', 'id' => $profissional->id],'class' => 'form', 'method' => 'PUT', 'enctype'=>'multipart/form-data']) !!}
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center">Perfil Profissional</h3>
                        </div>
                        <hr>
                        @include('profissionais._form')
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
<script>
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

        @if($profissional->latitude!="")
            myLatLng = new google.maps.LatLng({{$profissional->latitude}}, {{$profissional->longitude}});
            addMarker(myLatLng);
            map.setCenter(myLatLng);
            count_marker++;
        @else
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
        @endif

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
                count_marker = 0;
            } 
            
        }

    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC2UTdk-E7kWhTX-YUDQXUVc5FnQiaYIuA&callback=initMap" type="text/javascript"></script>
@endsection

@section('assets_scripts')
<script src="{{ asset('public/js/cropbox.js') }}"></script>
<script type="text/javascript">
    window.onload = function() {
        var options =
        {
            imageBox: '.imageBoxProf',
            thumbBox: '.thumbBoxProf',
            spinner: '.spinnerProf',
            @if($profissional->foto=="")
                imgSrc: '{{ asset("public/images/260x300.jpg") }}'
            @else
                imgSrc: '{{ asset($profissional->foto) }}'
            @endif
        }
        var cropper = new cropbox(options);
        document.querySelector('#foto').addEventListener('change', function(){
            var reader = new FileReader();
            reader.onload = function(e) {
                options.imgSrc = e.target.result;
                cropper = new cropbox(options);
            }
            reader.readAsDataURL(this.files[0]);
            setTimeout(function(){ autocrop(cropper, '1'); }, 300);
            this.files = [];
        })

        document.querySelector('#btnCropProf').addEventListener('click', function(){
            var img = cropper.getDataURL();
            document.querySelector('.croppedProf').innerHTML = '<img src="'+img+'">';
            $("#foto_crop").val(img);
        })
        document.querySelector('#btnZoomInProf').addEventListener('click', function(){
            cropper.zoomIn();
        })
        document.querySelector('#btnZoomOutProf').addEventListener('click', function(){
            cropper.zoomOut();
        })

    };

    function autocrop(cropper, id){
        var img = cropper.getDataURL();
        document.querySelector('.croppedProf').innerHTML = '<img src="'+img+'">';
        $("#foto_crop").val(img);
    }
    
</script>
@endsection
