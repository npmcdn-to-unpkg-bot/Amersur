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

    <div class="main-text">

        <div class="form-busqueda">
            {!! Form::model(Request::all(), ['method' => 'GET', 'class' => 'property-filters']) !!}

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        {!! Form::label('tipos', 'Tipo de Inmueble') !!}
                        <div class="ci-select">
                            {!! Form::select('t', [''=>'Seleccionar'] + $tipos , null , ['class' => 'postform']) !!}
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        {!! Form::label('moneda', 'Tipo de Moneda') !!}
                        <div class="ci-select">
                            {!! Form::select('m', [''=>'Seleccionar', 'dolar' => 'Dólar', 'soles' => 'Soles'], null , ['class' => 'postform']) !!}
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        {!! Form::label('precio', 'Precio máximo') !!}
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
            $inmueble_url = $inmueble->enlace;
            $inmueble_descripcion = $inmueble->contenido;
            $inmueble_imagen = '/upload/'.$inmueble->imagePr()->imagen_carpeta.'400x400/'.$inmueble->imagePr()->imagen;
            $inmueble_moneda = moneda($inmueble->moneda);
            $inmueble_precio = precio($inmueble->precio_venta);
            $inmueble_tipo = $inmueble->tipo->titulo;
            /*--}}
            <div class="col-sm-6 col-xs-12">
                <div class="item item-media">
                    <figure class="item-thumb">
                        <a href="{{ $inmueble_url }}" target="_blank">
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

            <div class="col-sm-12 col-xs-12 text-center">
                {!! $inmuebles->appends(Request::all())->render() !!}
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
@stop