<div class="banner visible-lg visible-md">

    <div id="slider_amersur" class="rev_slider fullwidthabanner" style="display:none;">

        <ul>

            @foreach($slider as $item)
            {{--*/
            $slider_id = $item->id;
            $slider_titulo = $item->titulo;
            $slider_descripcion = $item->descripcion;
            $slider_moneda = moneda($item->moneda);
            $slider_precio = $slider_moneda.precio($item->precio);
            $slider_enlace = $item->enlace;
            $slider_imagen = '/upload/'.$item->imagen_carpeta.$item->imagen;
            /*--}}
            {{-- SLIDER --}}
            <li data-index="rs-{{ $slider_id }}" data-transition="zoomin" data-slotamount="7" data-hideafterloop="0" data-hideslideonmobile="off"  data-easein="Power4.easeInOut" data-easeout="Power4.easeInOut" data-masterspeed="2000"  data-rotate="0"  data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="{{ $slider_titulo }}">

                {{-- IMAGEN --}}
                <img src="{{ $slider_imagen }}" alt="" data-bgposition="center center" data-kenburns="on" data-duration="30000" data-ease="Linear.easeNone" data-scalestart="100" data-scaleend="120" data-rotatestart="0" data-rotateend="0" data-offsetstart="0 0" data-offsetend="0 0" data-bgparallax="10" class="rev-slidebg" data-no-retina>

                {{-- FONDO --}}
                <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme" id="slide-18-layer-9" data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']" data-y="['middle','middle','middle','middle']" data-voffset="['227','231','191','141']" data-width="['full','full','full','full']" data-height="['150','141','119','119']" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power4.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-responsive_offset="on" style="z-index: 5;background-color:rgba(255, 255, 255, 0.60);border-color:rgba(0, 0, 0, 0.50);"></div>

                {{-- TITULO --}}
                <div class="tp-caption NotGeneric-Title tp-resizeme" id="slide-18-layer-1" data-x="['left','center','center','center']" data-hoffset="['38','-269','-158','-69']" data-y="['middle','middle','middle','middle']" data-voffset="['194','196','169','119']" data-fontsize="['30','30','30','20']" data-lineheight="['40','30','30','30']" data-width="none" data-height="none" data-whitespace="nowrap" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 6; white-space: nowrap; font-size: 30px; line-height: 40px; color: rgba(12, 12, 12, 1.00);">
                    {{ $slider_titulo }}
                </div>

                {{-- BOTON --}}
                <div class="tp-caption rev-btn rev-hiddenicon" id="slide-18-layer-12" data-x="['right','right','center','left']" data-hoffset="['40','20','0','20']" data-y="['top','top','top','top']" data-voffset="['550','530','449','345']" data-width="['none','none','none','229']" data-height="['none','none','none','44']" data-whitespace="['nowrap','nowrap','nowrap','normal']" data-visibility="['on','on','on','off']" data-transform_idle="o:1;" data-transform_hover="o:1;rX:0;rY:0;rZ:0;z:0;s:0;e:Linear.easeNone;" data-style_hover="c:rgba(0, 0, 0, 1.00);bg:rgba(42, 114, 0, 1.00);" data-transform_in="y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;s:2000;e:Power2.easeInOut;" data-transform_out="y:[100%];s:300;s:300;" data-mask_in="x:0px;y:[100%];" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" data-responsive="off" style="z-index: 7; white-space: nowrap; font-size: 17px; line-height: 17px; font-weight: 500; color: rgba(255, 255, 255, 1.00) !important;font-family:Roboto;background-color:rgba(89, 197, 75, 1);padding:12px 35px 12px 35px;border-style:solid;border-width:1px;border-radius:30px 30px 30px 30px;outline:none;box-shadow:none;box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;cursor:pointer;">
                    <a href="{{ $slider_enlace }}" style="color: #FFFFFF;">Ver detalles <i class="fa fa-eye"></i></a>
                </div>

                {{-- PRECIO --}}
                <div class="tp-caption tp-resizeme" id="slide-18-layer-13" data-x="['right','right','left','right']" data-hoffset="['38','18','369','10']" data-y="['top','top','top','top']" data-voffset="['480','480','403','346']" data-fontsize="['40','30','25','20']" data-lineheight="['40','40','40','50']" data-width="['393','393','393','270']" data-height="['45','45','45','46']" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="opacity:0;s:1500;e:Power2.easeInOut;" data-transform_out="opacity:0;s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 8; min-width: 393px; max-width: 393px; max-width: 45px; max-width: 45px; white-space: normal; font-size: 40px; line-height: 40px; font-weight: 900; color: rgba(12, 12, 12, 1.00);font-family:Roboto;text-align:right;">
                    {{ $slider_precio }}
                </div>

                {{-- DESCRIPCION --}}
                <div class="tp-caption tp-resizeme" id="slide-18-layer-14" data-x="['left','left','left','left']" data-hoffset="['38','27','27','27']" data-y="['top','top','top','top']" data-voffset="['518','516','516','516']" data-width="['570','634','634','634']" data-height="['76','77','77','77']" data-whitespace="normal" data-transform_idle="o:1;" data-transform_in="y:[-100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;s:1500;e:Power3.easeInOut;" data-transform_out="y:[100%];s:1000;e:Power2.easeInOut;s:1000;e:Power2.easeInOut;" data-mask_in="x:0px;y:0px;s:inherit;e:inherit;" data-mask_out="x:inherit;y:inherit;s:inherit;e:inherit;" data-start="1000" data-splitin="none" data-splitout="none" data-responsive_offset="on" style="z-index: 9; min-width: 570px; max-width: 570px; max-width: 76px; max-width: 76px; white-space: normal; font-size: 16px; line-height: 25px; font-weight: 400; color: rgba(12, 12, 12, 1.00);font-family:Arial, Helvetica, sans-serif;">
                    {{ $slider_descripcion }}
                </div>
            </li>
            @endforeach

        </ul>

        <div class="tp-static-layers"></div>
        <div class="tp-bannertimer" style="height: 7px; background-color: rgba(255, 255, 255, 0.25);"></div>

    </div>

</div>