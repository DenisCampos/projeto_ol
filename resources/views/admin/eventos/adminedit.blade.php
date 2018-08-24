@extends('layouts.sufee')

@section('assets_css')
<link rel="stylesheet" href="{{ asset('public/css/custom-sistema.css') }}" type="text/css" />
@endsection

@section('content')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Editar</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{route('home')}}">Home</a></li>
                    <li><a href="{{url($returnevent)}}">Eventos</a></li>
                    <li><a href="{{url($redirect_to)}}">Detalhar</a></li>
                    <li class="active">Editar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

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
                    {!! Form::model($evento,['route' => ['admin.eventos.adminupdate', 'id' => $evento->id],'class' => 'form', 'method' => 'PUT', 'enctype'=>'multipart/form-data']) !!}
                    {!! Form::hidden('returnevent', $returnevent) !!}
                    @include('eventos._form')
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

    @if($evento->latitude!="")
        myLatLng = new google.maps.LatLng({{$evento->latitude}}, {{$evento->longitude}});
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
            count_marker=0;
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
        var options1 =
        {
            imageBox: '.imageBox',
            thumbBox: '.thumbBox',
            spinner: '.spinner',
            @if($evento->imagem1=="")
                imgSrc: '{{ asset("public/images/700x400.png") }}'
            @else
                imgSrc: '{{ asset($evento->imagem1) }}'
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
            @if($evento->imagem2=="")
                imgSrc: '{{ asset("public/images/700x400.png") }}'
            @else
                imgSrc: '{{ asset($evento->imagem2) }}'
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
</script>
@endsection