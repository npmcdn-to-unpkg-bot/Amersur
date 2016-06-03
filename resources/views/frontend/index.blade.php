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

    <div class="banner">

        <div id="slider_amersur" class="rev_slider fullwidthabanner" style="display:none;">

            <ul>
                {{-- SLIDER --}}
                <li data-index="rs-1" data-transition="zoomin" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Ken Burns">

                    {{-- IMAGEN --}}
                    <img src="/upload/slider/img1.jpg" alt="" data-bgposition="center center" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>

                    {{-- FONDO --}}
                    <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme" id="slide-18-layer-9" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['227','231','191','141']" data-width="['full','full','full','full']" data-height="['150','141','119','119']" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-responsive_offset="on" style="z-index: 5;background-color:rgba(255, 255, 255, 0.60);border-color:rgba(0, 0, 0, 0.50);"></div>

                    {{-- TITULO --}}
                    <div class="tp-caption NotGeneric-Title tp-resizeme" id="slide-18-layer-1" data-x="['center','center','center','center']" data-hoffset="['-365','-269','-158','-69']" data-y="['middle','middle','middle','middle']" data-voffset="['194','196','169','119']" data-fontsize="['30','30','30','20']" data-lineheight="['40','30','30','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; white-space: nowrap; font-size: 30px; line-height: 40px; color: rgba(12, 12, 12, 1.00);">
                        Premium Computer Hardware
                    </div>

                    {{-- BOTON --}}
                    <div class="tp-caption rev-btn rev-hiddenicon" id="slide-18-layer-12" data-x="['right','right','center','left']" data-hoffset="['40','20','0','20']" data-y="['top','top','top','top']" data-voffset="['550','530','449','345']" data-width="['none','none','none','229']" data-height="['none','none','none','44']" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-visibility="['on','on','on','off']" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:0;e:Linear.easeNone;" data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(243, 168, 71, 1.00);" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="y:[100%];s:300;s:300;" data-mask_in="x:0px;y:[100%];" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 7; white-space: nowrap; font-size: 17px; line-height: 17px; font-weight: 500; color: rgba(12, 12, 12, 1.00);font-family:Roboto;background-color:rgba(254, 207, 114, 0.75);padding:12px 35px 12px 35px;border-color:rgba(0, 0, 0, 1.00);border-style:solid;border-width:1px;border-radius:30px 30px 30px 30px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">
                        Ver detalles <i class="fa fa-eye"></i>
                    </div>

                    {{-- PRECIO --}}
                    <div class="tp-caption tp-resizeme" id="slide-18-layer-13" data-x="['right','right','left','right']" data-hoffset="['38','18','369','10']" data-y="['top','top','top','top']" data-voffset="['480','480','403','346']" data-fontsize="['40','30','25','20']" data-lineheight="['40','40','40','50']" data-width="['393','393','393','270']" data-height="['45','45','45','46']" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; min-width: 393px; max-width: 393px; max-width: 45px; max-width: 45px; white-space: normal; font-size: 40px; line-height: 40px; font-weight: 900; color: rgba(12, 12, 12, 1.00);font-family:Roboto;text-align:right;">
                        S/. 1,984,685.00
                    </div>

                    {{-- DESCRIPCION --}}
                    <div class="tp-caption tp-resizeme" id="slide-18-layer-14" data-x="['left','left','left','left']" data-hoffset="['17','27','27','27']" data-y="['top','top','top','top']" data-voffset="['518','516','516','516']" data-width="['570','634','634','634']" data-height="['76','77','77','77']" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 9; min-width: 570px; max-width: 570px; max-width: 76px; max-width: 76px; white-space: normal; font-size: 16px; line-height: 25px; font-weight: 400; color: rgba(12, 12, 12, 1.00);font-family:Arial, Helvetica, sans-serif;">
                        Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio.
                    </div>
                </li>
            </ul>

            <div class="tp-static-layers"></div>
            <div class="tp-bannertimer" style="height: 7px; background-color: rgba(255, 255, 255, 0.25);"></div>

        </div>

    </div>

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
            $inmueble_descripcion = $inmueble->descripcion;
            $inmueble_imagen = '/upload/'.$inmueble->imagePr()->imagen_carpeta.'400x400/'.$inmueble->imagePr()->imagen;
            $inmueble_moneda = moneda($inmueble->moneda);
            $inmueble_precio = $inmueble->precio_venta;
            /*--}}
            <div class="col-sm-6 col-xs-12">
                <div class="item item-media">
                    <figure class="item-thumb">
                        <a href="{{ $inmueble_url }}">
                            <img src="{{ $inmueble_imagen }}" alt="{{ $inmueble_titulo }}" sizes="(max-width: 555px) 100vw, 555px">
                        </a>
                    </figure>

                    <div class="item-content">
                        <p class="item-title"><a href="{{ $inmueble_url }}">{{ $inmueble_titulo }}</a></p>

                        <div class="item-excerpt">
                            <p>{{ $inmueble_descripcion }}</p>
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