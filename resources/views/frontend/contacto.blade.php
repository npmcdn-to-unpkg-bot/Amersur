@extends('layouts.frontend')

@section('contenido_header')
@stop

@section('contenido_body')
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main about-main">
        <div class="contact">
            <h3>Nos encontramos en</h3>

            <div class="map">

                <div id="map"
                     data-map-zoom="16"
                     data-map-latlng="{{ $contacto->mapa }}"
                     data-map-marker="imagenes/logo-map.png"
                     data-map-marker-size="47*70"></div>

            </div>


            <div class="contact-grids">
                <div class="col-md-4 address">
                    <h3>Info de Contacto</h3>
                    {!! $contacto->contenido  !!}
                </div>
                <div class="col-md-8 contact-form">
                    <h3>Contacto</h3>

                    <div id="mensaje-enviado" style="display: none;">

                        <div class="block-header" style="padding-top: 0;">
                            <h3 class="title">Tu mensaje ha sido enviado.</h3>
                            <div class="description">En breve nos estaremos comunicando contigo.</div>
                        </div>

                    </div>

                    {!! Form::open(['route' => 'frontend.contacto.post', 'method' => 'POST', 'id' => 'contactForm']) !!}

                        {!! Form::text('nombre', null, ['placeholder' => 'Nombre', 'required']) !!}

                        {!! Form::email('email', null, ['placeholder' => 'Email', 'required']) !!}

                        {!! Form::text('telefono', null, ['placeholder' => 'Teléfono', 'required']) !!}

                        {!! Form::textarea('mensaje', null, ['placeholder' => 'Mensaje', 'required']) !!}

                        <div class="g-recaptcha home" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>

                        <a class="button style-10" href="#" id="formContactoSubmit">Enviar mensaje</a>

                        <div class="progressForm col-xs-6">
                            <i class="fa fa-2x fa-circle-o-notch fa-spin"></i>
                        </div>

                    {!! Form::close() !!}

                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
@stop

@section('contenido_footer')
{{-- RECAPTCHA --}}
{!! HTML::script('https://www.google.com/recaptcha/api.js') !!}

{{-- CONTACTO --}}
<script>

    $(document).on("ready", function(){

        $('.progressForm .fa').hide();

        $("#formContactoSubmit").on("click", function(e){

            e.preventDefault();

            var form = $("#contactForm");
            var url = form.attr('action');
            var data = form.serialize();

            $('.progressForm .fa').show();

            $.post(url, data, function(result){
                $('.progressForm .fa').hide();
                $(".contact-content").addClass('alert').addClass('alert-success').text(result.message);
                form.slideUp();
                $('#mensaje-enviado').slideDown();
                form[0].reset();
            }).fail(function(result){
                $('.progressForm .fa').hide();
                console.log(result);
                $(".contact-content").text("Se produjo un error al enviar el mensaje. Intentelo de nuevo más tarde.");

                if(result.status === 422){

                    var errors = result.responseJSON;

                    errorsHtml = '<div class="alert alert-danger"><ul>';
                    $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>';
                    });
                    errorsHtml += '</ul></di>';

                    $('.contact-content').html(errorsHtml);

                };

            });

        });

    });

</script>

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