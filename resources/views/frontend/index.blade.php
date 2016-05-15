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
        <div id="rev_slider_213_1_wrapper" class="rev_slider_wrapper fullwidthbanner-container" data-alias="woocommercebig" style="margin:0px auto;background-color:transparent;padding:0px;margin-top:0px;margin-bottom:0px;">
            <div id="rev_slider_213_1" class="rev_slider fullwidthabanner" style="display:none;" data-version="5.1.1RC">
                <ul>
                    {{-- SLIDER --}}
                    <li data-index="rs-1" data-transition="slideremovehorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1000" data-fsslotamount="7" data-saveperformance="off" data-title="Premium Computer Hardware" data-description="">
                        {{-- IMAGEN --}}
                        <img src="/upload/slider/dummy.png" alt="" width="1200" height="600" data-lazyload="/upload/slider/img1.jpg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

                        {{-- TITULO --}}
                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['30','30','30','30']" data-y="['top','top','top','top']" data-voffset="['30','30','30','30']" data-width="['430','430','430','420']" data-height="540" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1200;e:Power3.easeInOut;s:1200;e:Power3.easeInOut;" data-start="500" data-responsive_offset="on" style="z-index: 5;background-color:rgba(255, 255, 255, 0.8);border-color:rgba(0, 0, 0, 0);"></div>

                        {{-- TITULO --}}
                        <div class="tp-caption Woo-TitleLarge tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['60','60','60','60']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="600" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; min-width: 370px; max-width: 370px; white-space: normal;text-align:center;">Premium Computer Hardware</div>

                        {{-- DESCRIPCION --}}
                        <div class="tp-caption Woo-Rating tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['225','225','225','225']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; min-width: 370px; max-width: 370px; white-space: normal; line-height: 22px;text-align:center;">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio.</div>

                        {{-- PRECIO TEXTO --}}
                        <div class="tp-caption Woo-SubTitle tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','59','59','55']" data-y="['top','top','top','top']" data-voffset="['350','350','350','350']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 9; min-width: 370px; max-width: 370px; white-space: normal;text-align:center;">DESDE</div>

                        {{-- PRECIO NUMERO --}}
                        <div class="tp-caption Woo-PriceLarge tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['380','380','380','380']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 10; min-width: 370px; max-width: 370px; white-space: normal; font-size: 40px; line-height: 40px;text-align:center;"><span class="amount">S/. 399.00</span></div>

                        {{-- BOTON INFO --}}
                        <a class="tp-caption Woo-AddToCart rev-btn tp-resizeme" href="#" target="_self" data-x="['left','left','left','left']" data-hoffset="['139','139','139','132']" data-y="['top','top','top','top']" data-voffset="['449','449','449','450']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:200;e:Power1.easeInOut;" data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(243, 168, 71, 1.00);cursor:pointer;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1100" data-splitin="none" data-splitout="none" data-actions='' data-responsive_offset="on" style="z-index: 12; white-space: nowrap;padding:12px 75px 12px 50px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"><i class="pe-7s-look" style="font-size:25px; float: left; margin-top: -6px; margin-right: 6px;"></i> Ver detalles</a>
                    </li>
                    {{-- SLIDER --}}
                    <li data-index="rs-2" data-transition="slideremovehorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1000" data-fsslotamount="7" data-saveperformance="off" data-title="Premium Computer Hardware" data-description="">
                        {{-- IMAGEN --}}
                        <img src="/upload/slider/dummy.png" alt="" width="1200" height="600" data-lazyload="/upload/slider/img2.jpg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

                        {{-- TITULO --}}
                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['30','30','30','30']" data-y="['top','top','top','top']" data-voffset="['30','30','30','30']" data-width="['430','430','430','420']" data-height="540" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1200;e:Power3.easeInOut;s:1200;e:Power3.easeInOut;" data-start="500" data-responsive_offset="on" style="z-index: 5;background-color:rgba(255, 255, 255, 0.8);border-color:rgba(0, 0, 0, 0);"></div>

                        {{-- TITULO --}}
                        <div class="tp-caption Woo-TitleLarge tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['60','60','60','60']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="600" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; min-width: 370px; max-width: 370px; white-space: normal;text-align:center;">Premium Computer Hardware</div>

                        {{-- DESCRIPCION --}}
                        <div class="tp-caption Woo-Rating tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['225','225','225','225']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; min-width: 370px; max-width: 370px; white-space: normal; line-height: 22px;text-align:center;">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio.</div>

                        {{-- PRECIO TEXTO --}}
                        <div class="tp-caption Woo-SubTitle tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','59','59','55']" data-y="['top','top','top','top']" data-voffset="['350','350','350','350']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 9; min-width: 370px; max-width: 370px; white-space: normal;text-align:center;">DESDE</div>

                        {{-- PRECIO NUMERO --}}
                        <div class="tp-caption Woo-PriceLarge tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['380','380','380','380']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 10; min-width: 370px; max-width: 370px; white-space: normal; font-size: 40px; line-height: 40px;text-align:center;"><span class="amount">S/. 399.00</span></div>

                        {{-- BOTON INFO --}}
                        <a class="tp-caption Woo-AddToCart rev-btn tp-resizeme" href="#" target="_self" data-x="['left','left','left','left']" data-hoffset="['139','139','139','132']" data-y="['top','top','top','top']" data-voffset="['449','449','449','450']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:200;e:Power1.easeInOut;" data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(243, 168, 71, 1.00);cursor:pointer;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1100" data-splitin="none" data-splitout="none" data-actions='' data-responsive_offset="on" style="z-index: 12; white-space: nowrap;padding:12px 75px 12px 50px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"><i class="pe-7s-look" style="font-size:25px; float: left; margin-top: -6px; margin-right: 6px;"></i> Ver detalles</a>
                    </li>
                    {{-- SLIDER --}}
                    <li data-index="rs-3" data-transition="slideremovehorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1000" data-fsslotamount="7" data-saveperformance="off" data-title="Premium Computer Hardware" data-description="">
                        {{-- IMAGEN --}}
                        <img src="/upload/slider/dummy.png" alt="" width="1200" height="600" data-lazyload="/upload/slider/img3.jpg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

                        {{-- TITULO --}}
                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['30','30','30','30']" data-y="['top','top','top','top']" data-voffset="['30','30','30','30']" data-width="['430','430','430','420']" data-height="540" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1200;e:Power3.easeInOut;s:1200;e:Power3.easeInOut;" data-start="500" data-responsive_offset="on" style="z-index: 5;background-color:rgba(255, 255, 255, 0.8);border-color:rgba(0, 0, 0, 0);"></div>

                        {{-- TITULO --}}
                        <div class="tp-caption Woo-TitleLarge tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['60','60','60','60']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="600" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; min-width: 370px; max-width: 370px; white-space: normal;text-align:center;">Premium Computer Hardware</div>

                        {{-- DESCRIPCION --}}
                        <div class="tp-caption Woo-Rating tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['225','225','225','225']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; min-width: 370px; max-width: 370px; white-space: normal; line-height: 22px;text-align:center;">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio.</div>

                        {{-- PRECIO TEXTO --}}
                        <div class="tp-caption Woo-SubTitle tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','59','59','55']" data-y="['top','top','top','top']" data-voffset="['350','350','350','350']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 9; min-width: 370px; max-width: 370px; white-space: normal;text-align:center;">DESDE</div>

                        {{-- PRECIO NUMERO --}}
                        <div class="tp-caption Woo-PriceLarge tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['380','380','380','380']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 10; min-width: 370px; max-width: 370px; white-space: normal; font-size: 40px; line-height: 40px;text-align:center;"><span class="amount">S/. 399.00</span></div>

                        {{-- BOTON INFO --}}
                        <a class="tp-caption Woo-AddToCart rev-btn tp-resizeme" href="#" target="_self" data-x="['left','left','left','left']" data-hoffset="['139','139','139','132']" data-y="['top','top','top','top']" data-voffset="['449','449','449','450']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:200;e:Power1.easeInOut;" data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(243, 168, 71, 1.00);cursor:pointer;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1100" data-splitin="none" data-splitout="none" data-actions='' data-responsive_offset="on" style="z-index: 12; white-space: nowrap;padding:12px 75px 12px 50px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"><i class="pe-7s-look" style="font-size:25px; float: left; margin-top: -6px; margin-right: 6px;"></i> Ver detalles</a>
                    </li>
                    {{-- SLIDER --}}
                    <li data-index="rs-4" data-transition="slideremovehorizontal" data-slotamount="default" data-easein="default" data-easeout="default" data-masterspeed="default" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1000" data-fsslotamount="7" data-saveperformance="off" data-title="Premium Computer Hardware" data-description="">
                        {{-- IMAGEN --}}
                        <img src="/upload/slider/dummy.png" alt="" width="1200" height="600" data-lazyload="/upload/slider/img4.jpg" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" data-bgparallax="5" class="rev-slidebg" data-no-retina>

                        {{-- TITULO --}}
                        <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['30','30','30','30']" data-y="['top','top','top','top']" data-voffset="['30','30','30','30']" data-width="['430','430','430','420']" data-height="540" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1200;e:Power3.easeInOut;s:1200;e:Power3.easeInOut;" data-start="500" data-responsive_offset="on" style="z-index: 5;background-color:rgba(255, 255, 255, 0.8);border-color:rgba(0, 0, 0, 0);"></div>

                        {{-- TITULO --}}
                        <div class="tp-caption Woo-TitleLarge tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['60','60','60','60']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="600" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; min-width: 370px; max-width: 370px; white-space: normal;text-align:center;">Premium Computer Hardware</div>

                        {{-- DESCRIPCION --}}
                        <div class="tp-caption Woo-Rating tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['225','225','225','225']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="800" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; min-width: 370px; max-width: 370px; white-space: normal; line-height: 22px;text-align:center;">Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio.</div>

                        {{-- PRECIO TEXTO --}}
                        <div class="tp-caption Woo-SubTitle tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','59','59','55']" data-y="['top','top','top','top']" data-voffset="['350','350','350','350']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="900" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 9; min-width: 370px; max-width: 370px; white-space: normal;text-align:center;">DESDE</div>

                        {{-- PRECIO NUMERO --}}
                        <div class="tp-caption Woo-PriceLarge tp-resizeme" data-x="['left','left','left','left']" data-hoffset="['60','60','60','55']" data-y="['top','top','top','top']" data-voffset="['380','380','380','380']" data-width="370" data-height="none" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 10; min-width: 370px; max-width: 370px; white-space: normal; font-size: 40px; line-height: 40px;text-align:center;"><span class="amount">S/. 399.00</span></div>

                        {{-- BOTON INFO --}}
                        <a class="tp-caption Woo-AddToCart rev-btn tp-resizeme" href="#" target="_self" data-x="['left','left','left','left']" data-hoffset="['139','139','139','132']" data-y="['top','top','top','top']" data-voffset="['449','449','449','450']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:200;e:Power1.easeInOut;" data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(243, 168, 71, 1.00);cursor:pointer;" data-transform_in="z:0;rX:0;rY:0;rZ:0;sX:0.9;sY:0.9;skX:0;skY:0;opacity:0;s:1500;e:Power3.easeOut;" data-transform_out="x:left;s:1000;e:Power3.easeInOut;s:1000;e:Power3.easeInOut;" data-start="1100" data-splitin="none" data-splitout="none" data-actions='' data-responsive_offset="on" style="z-index: 12; white-space: nowrap;padding:12px 75px 12px 50px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;"><i class="pe-7s-look" style="font-size:25px; float: left; margin-top: -6px; margin-right: 6px;"></i> Ver detalles</a>
                    </li>
                </ul>
                <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
            </div>
        </div>
    </div>

    <div class="main-text">
        <div class="welcome">
            <h3>Welcome to our page</h3>
            <div class="col-md-4 welcome-left">
                <img src="images/img6.jpg" alt="">
            </div>
            <div class="col-md-8 welcome-right">
                <h4>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin established fact that a reader will be distracted Lorem Ipsum when looking at its layout.</h4>
                <p>Lorem Ipsum was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions.
                    It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution is that it has a more of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="offer-grids">
            <h3>Our best offers</h3>
            <div class="col-md-4 offer-grids-info">
                <img src="images/img2.jpg" alt=""/>
                <div class="offer-text">
                    <h5>$94.675</h5>
                </div>
            </div>
            <div class="col-md-4 offer-grids-info">
                <img src="images/img3.jpg" alt=""/>
                <div class="offer-text">
                    <h5>$94.675</h5>
                </div>
            </div>
            <div class="col-md-4 offer-grids-info">
                <img src="images/img13.jpg" alt=""/>
                <div class="offer-text">
                    <h5>$144.5</h5>
                </div>
            </div>
            <div class="col-md-6 offer-grids-info off-grid2">
                <img src="images/img4.jpg" alt=""/>
                <div class="offer-text">
                    <h5>$366.5</h5>
                </div>
            </div>
            <div class="col-md-6 offer-grids-info off-grid2">
                <img src="images/img5.jpg" alt=""/>
                <div class="offer-text">
                    <h5>$194.75</h5>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>

        <div class="features">
            <div class="col-md-6 feature-left">
                <h3>Our professional management</h3>
                <div class="ftrs-left-text">
                    <h4>The standard Lorem Ipsum passage, used sincepassage</h4>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident <p>
                </div>
                <div class="ftrs-left-text">
                    <h4>The standard Lorem Ipsum passage, used sincepassage</h4>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident <p>
                </div>
                <div class="ftrs-left-text">
                    <h4>The standard Lorem Ipsum passage, used sincepassage</h4>
                    <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident <p>
                </div>
            </div>
            <div class="col-md-6 feature-right">
                <h3>Featured services</h3>
                <ul class="menu">
                    <li class="item1"><a href="#">Nemo enim ipsam <span class="icon"> </span></a>
                        <ul>
                            <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</a></li>
                        </ul>
                    </li>
                    <li class="item2"><a href="#">Voluptatemdolor <span class="icon"> </span></a>
                        <ul>
                            <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</a></li>
                        </ul>
                    </li>
                    <li class="item3"><a href="#">Odit aut fugit <span class="icon"> </span></a>
                        <ul>
                            <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</a></li>
                        </ul>
                    </li>
                    <li class="item4"><a href="#">Temdolorlupta <span class="icon"> </span></a>
                        <ul>
                            <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</a></li>
                        </ul>
                    </li>
                    <li class="item5"><a href="#">Ptatemdolor aut <span class="icon"> </span></a>
                        <ul>
                            <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</a></li>
                        </ul>
                    </li>
                    <li class="item5"><a href="#">Dolor autptatem <span class="icon"> </span></a>
                        <ul>
                            <li class="subitem1"><a href="#">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia.</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
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
    var tpj = jQuery;

    var revapi213;
    tpj(document).ready(function() {
        if (tpj("#rev_slider_213_1").revolution == undefined) {
            revslider_showDoubleJqueryError("#rev_slider_213_1");
        } else {
            revapi213 = tpj("#rev_slider_213_1").show().revolution({
                sliderType: "standard",
                jsFileLocation: "/libs/revolution/js/",
                sliderLayout: "auto",
                dottedOverlay: "none",
                delay: 9000,
                navigation: {
                    keyboardNavigation: "off",
                    keyboard_direction: "horizontal",
                    mouseScrollNavigation: "off",
                    onHoverStop: "on",
                    touch: {
                        touchenabled: "on",
                        swipe_threshold: 75,
                        swipe_min_touches: 50,
                        swipe_direction: "horizontal",
                        drag_block_vertical: false
                    },
                    arrows: {
                        style: "gyges",
                        enable: true,
                        hide_onmobile: false,
                        hide_onleave: false,
                        tmp: '',
                        left: {
                            h_align: "right",
                            v_align: "bottom",
                            h_offset: 40,
                            v_offset: 0
                        },
                        right: {
                            h_align: "right",
                            v_align: "bottom",
                            h_offset: 0,
                            v_offset: 0
                        }
                    }
                },
                responsiveLevels: [1240, 1024, 778, 480],
                visibilityLevels: [1240, 1024, 778, 480],
                gridwidth: [1200, 1024, 778, 480],
                gridheight: [600, 600, 600, 600],
                lazyType: "single",
                parallax: {
                    type: "scroll",
                    origo: "slidercenter",
                    speed: 400,
                    levels: [5, 10, 15, 20, 25, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55],
                    type: "scroll",
                },
                shadow: 0,
                spinner: "off",
                stopLoop: "off",
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: "off",
                autoHeight: "off",
                disableProgressBar: "on",
                hideThumbsOnMobile: "off",
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: "off",
                    nextSlideOnWindowFocus: "off",
                    disableFocusListener: false,
                }
            });
        }
    }); /*ready*/
</script>

@stop