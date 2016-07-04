@extends('layouts.frontend')

@section('contenido_header')

<!-- LOADING FONTS AND ICONS -->
{!! HTML::style('http://fonts.googleapis.com/css?family=Raleway:500,800') !!}

{!! HTML::style('libs/revolution/fonts/pe-icon-7-stroke/css/pe-icon-7-stroke.css') !!}
{!! HTML::style('') !!}

<!-- REVOLUTION STYLE SHEETS -->
{!! HTML::style('libs/revolution/css/settings.css') !!}

<!-- REVOLUTION LAYERS STYLES -->
{!! HTML::style('libs/revolution/css/layers.css') !!}

<!-- REVOLUTION NAVIGATION STYLES -->
{!! HTML::style('libs/revolution/css/navigation.css') !!}

@stop

@section('contenido_body')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">

    @include('partials.slider')

    <div class="main-text">

        <div class="form-busqueda">
            {!! Form::open(['route' => 'frontend.inmuebles', 'method' => 'GET', 'class' => 'property-filters']) !!}

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        {!! Form::label('t', 'Tipo de Inmueble') !!}
                        <div class="ci-select">
                            {!! Form::select('t', [''=>'Seleccionar'] + $tipos , null , ['class' => 'postform']) !!}
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        {!! Form::label('m', 'Tipo de Moneda') !!}
                        <div class="ci-select">
                            {!! Form::select('m', [''=>'Seleccionar', 'dolar' => 'Dólar', 'soles' => 'Soles'], null , ['class' => 'postform']) !!}
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        {!! Form::label('p', 'Precio máximo') !!}
                        {!! Form::number('p', null, ['min' => '0', 'step' => '100', 'id' => 'property_max_price']) !!}

                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        {!! Form::submit('Buscar propiedades', ['class' => 'property-filters-submit']) !!}
                    </div>
                </div>

            {!! Form::close() !!}
        </div>

        <div class="offer-grids">
            <h3>Inmuebles</h3>

            @foreach($inmuebles as $inmueble)
            {{--*/
            $inmueble_titulo = $inmueble->titulo;
            $inmueble_url = route('frontend.inmueble', [$inmueble->id, $inmueble->slug_url]);
            $inmueble_descripcion = $inmueble->contenido;
            $inmueble_imagen = '/upload/'.$inmueble->imagePr()->imagen_carpeta.'400x400/'.$inmueble->imagePr()->imagen;
            $inmueble_moneda = moneda($inmueble->moneda);
            $inmueble_precio = precio($inmueble->precio_venta);
            $inmueble_tipo = $inmueble->tipo->titulo;
            /*--}}
            <div class="col-sm-12 col-xs-12">
                <div class="item item-media">
                    <figure class="item-thumb">
                        <a href="{{ $inmueble_url }}">
                            <img src="{{ $inmueble_imagen }}" alt="{{ $inmueble_titulo }}" sizes="(max-width: 555px) 100vw, 555px">
                        </a>
                    </figure>

                    <div class="item-content">
                        <p class="item-category">{{ $inmueble_tipo }}</p>
                        <p class="item-title"><a href="{{ $inmueble_url }}">{{ $inmueble_titulo }}</a></p>

                        <div class="item-excerpt">
                            <p>{!! $inmueble_descripcion !!}</p>
                        </div>

                        <a href="{{ $inmueble_url }}" class="item-more property-price">{{ $inmueble_moneda.$inmueble_precio }}</a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="clearfix"> </div>
        </div>

    </div>

</div>
@stop

@section('contenido_footer')
{{-- Script Tabs --}}
<script type="text/javascript">
    $(function() {

        var menu_ul = $('.menu > li > ul'),
                menu_a  = $('.menu > li > a');

        menu_ul.hide();

        menu_a.click(function(e) {
            e.preventDefault();
            if(!$(this).hasClass('active')) {
                menu_a.removeClass('active');
                menu_ul.filter(':visible').slideUp('normal');
                $(this).addClass('active').next().stop(true,true).slideDown('normal');
            } else {
                $(this).removeClass('active');
                $(this).next().stop(true,true).slideUp('normal');
            }
        });

    });
</script>

<!-- REVOLUTION JS FILES -->
{!! HTML::script('libs/revolution/js/jquery.themepunch.tools.min.js') !!}
{!! HTML::script('libs/revolution/js/jquery.themepunch.revolution.min.js') !!}

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS -->
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.actions.min.js') !!}
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.carousel.min.js') !!}
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.kenburn.min.js') !!}
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.layeranimation.min.js') !!}
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.migration.min.js') !!}
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.navigation.min.js') !!}
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.parallax.min.js') !!}
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.slideanims.min.js') !!}
{!! HTML::script('libs/revolution/js/extensions/revolution.extension.video.min.js') !!}

<script type="text/javascript">
    var tpj=jQuery;
    var revapi;
    tpj(document).ready(function() {
        if(tpj("#slider_amersur").revolution == undefined){
            revslider_showDoubleJqueryError("#slider_amersur");
        }else{
            revapi = tpj("#slider_amersur").show().revolution({
                sliderType:"standard",
                sliderLayout:"auto",
                dottedOverlay:"none",
                delay:9000,
                navigation: {
                    keyboardNavigation:"off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation:"off",
                    onHoverStop:"off",
                    arrows: {
                        style:"custom",
                        enable:true,
                        hide_onmobile:false,
                        hide_onleave:true,
                        hide_delay:200,
                        hide_delay_mobile:1200,
                        tmp:'',
                        left: {
                            h_align:"left",
                            v_align:"center",
                            h_offset:30,
                            v_offset:0
                        },
                        right: {
                            h_align:"right",
                            v_align:"center",
                            h_offset:30,
                            v_offset:0
                        }
                    }
                },
                responsiveLevels:[1240,1024,778,480],
                visibilityLevels:[1240,1024,778,480],
                gridwidth:[1200,1024,778,480],
                gridheight:[600,600,500,400],
                lazyType:"none",
                parallax: {
                    type:"mouse",
                    origo:"slidercenter",
                    speed:2000,
                    levels:[2,3,4,5,6,7,12,16,10,50,47,48,49,50,51,55]
                },
                shadow:0,
                spinner:"spinner0",
                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,
                shuffle:"off",
                autoHeight:"off",
                hideThumbsOnMobile:"on",
                hideSliderAtLimit:0,
                hideCaptionAtLimit:0,
                hideAllCaptionAtLilmit:0,
                debugMode:false,
                fallbacks: {
                    simplifyAll:"off",
                    nextSlideOnWindowFocus:"off",
                    disableFocusListener:false,
                }
            });
        }
    }); /*ready*/
</script>

@stop