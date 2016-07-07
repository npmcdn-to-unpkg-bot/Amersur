@extends('layouts.admin')

@section('contenido_admin_title')
    Contacto
@stop

@section('contenido_admin')
<div class="row">
	<!--row starts-->
	<div class="col-lg-12">

        @include('flash::message')

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </ul>
            </div>
        @endif

		<!--basic form starts-->
		<div class="portlet box blue-hoki">

            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe"></i>Contacto
                </div>
            </div>

			<div class="portlet-body form">
				{!! Form::model($contacto, ['route' => 'admin.contacto.update', 'method' => 'PUT', 'class' => 'form-horizontal form-bordered', 'files' => 'true']) !!}

                    <div class="form-group">
                        {!! Form::label('mapa', 'Mapa (Coordenadas)', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-3">
                            {!! Form::text('mapa', null, ['id' => 'mapa', 'class' => 'form-control']) !!}
                        </div>
                        <div class="col-md-6">
                            <a href="https://www.google.com.pe/maps" target="_blank">SELECIONAR COORDENADAS.</a>
                            <span>Para poder agregar el mapa, se tiene que seleccionar las coordenadas en Google Maps. En el Manual, se encuentra los pasos para obtener las coordenadas.</span>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('Mapa (Vista previa)', 'Mapa (Vista previa)', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            <div id="map" style="width:100%;height:300px;" 
                                data-map-zoom="16" 
                                data-map-latlng="{{ $contacto->mapa }}" 
                                data-map-marker="/imagenes/logo-map.png" 
                                data-map-marker-size="47*70"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('contenido', 'Info de Contacto', ['class' => 'col-md-3 control-label']) !!}
                        <div class="col-md-9">
                            {!! Form::textarea('contenido', null, ['class' => 'form-control ckeditor_full']) !!}
                        </div>
                    </div>

                    <!-- Form actions -->
                    <div class="form-group">
                        <div class="col-md-12 text-right">
                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-responsive btn-primary btn-md']) !!}
                        </div>
                    </div>

				{!! Form::close() !!}
			</div>
		</div>

	</div>
	<!--md-6 ends-->

</div>

@stop

@section('contenido_footer')
{{-- CKEDITOR --}}
{!! HTML::script('assets/global/plugins/ckeditor/ckeditor.js') !!}
{!! HTML::script('assets/global/plugins/ckeditor/adapters/jquery.js') !!}
{!! HTML::script('assets/admin/pages/scripts/ckeditor.js') !!}

{{-- MAPS --}}
{!! HTML::script('http://maps.google.com/maps/api/js?sensor=false') !!}

<script>
$(document).on("ready", function(){

    GoogleMap();

});

/*==============================
    Google map
==============================*/
function GoogleMap() {
    if ($('#map').length) {
        // Option map
        var $map = $('#map'),
            mapZoom = $map.data('map-zoom'),
            lat = $map.data('map-latlng').split(',')[0],
            lng = $map.data('map-latlng').split(',')[1],
            marker = $map.data('map-marker'),
            width = parseInt($map.data('map-marker-size').split('*')[0]),
            height = parseInt($map.data('map-marker-size').split('*')[1]);

        // Map
        if (isMobile.any()) {
            var noDraggableMobile = false;
        } else {
            var noDraggableMobile = true;
        }
        var MY_MAPTYPE_ID = 'custom_style';
        var latlng = new google.maps.LatLng(lat, lng);
        var settings = {
            zoom: mapZoom,
            center: latlng,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, MY_MAPTYPE_ID]
            },
            mapTypeControl: false,
            mapTypeId: MY_MAPTYPE_ID,
            scrollwheel: false,
            draggable: noDraggableMobile,
        };

        var map = new google.maps.Map(document.getElementById("map"), settings);
        var styledMapOptions = {
            name: 'Custom Style'
        };
        var customMapType = new google.maps.StyledMapType(styledMapOptions);

        map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

        google.maps.event.addDomListener(window, "resize", function () {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
        var companyImage = new google.maps.MarkerImage(marker,
            new google.maps.Size(width, height),
            new google.maps.Point(0, 0)
        );
        var companyPos = new google.maps.LatLng(lat, lng);
        var companyMarker = new google.maps.Marker({
            position: companyPos,
            map: map,
            icon: companyImage,
            title: "Ubicación",
            zIndex: 3
        });
    }
}

var isMobile = {
    Android: function() {
        return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function() {
        return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function() {
        return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function() {
        return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function() {
        return navigator.userAgent.match(/IEMobile/i);
    },
    any: function() {
        return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
}

</script>

@stop