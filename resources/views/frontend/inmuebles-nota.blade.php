@extends('layouts.frontend')

{{--*/
$row_id = $inmueble->id;
$row_titulo = $inmueble->titulo;
$row_descripcion = $inmueble->descripcion;
$row_contenido = $inmueble->contenido;
$row_tipo = $inmueble->tipo->titulo;
$row_area_total = $inmueble->area_total;
$row_area_construida = $inmueble->area_construida;
$row_moneda = moneda($inmueble->moneda);
$row_precio_alquiler = precio($inmueble->precio_alquiler);
$row_precio_venta = precio($inmueble->precio_venta);
$row_imagen = '/upload/'.$inmueble->imagePr()->imagen_carpeta.'1200x600/'.$inmueble->imagePr()->imagen;
/*--}}

@section('contenido_header')
    {!! HTML::style('js/fancybox/jquery.fancybox.css?v=2.1.4') !!}
@stop

@section('contenido_body')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main about-main">

    <div class="about-slid">
        <img src="{{ $row_imagen }}" alt="{{ $row_titulo }}">
    </div>

    <div class="team">
        <h3>{{ $row_titulo }}</h3>

        <div class="team-info">
            <div class="box-container">
                <div class="row">
                    <div class="col-md-4">
                        <h3>Detalles</h3>
                        <table class="property-overview">
                            <tbody>
                            <tr>
                                <th>Tipo de Inmueble</th>
                                <td>{{ $row_tipo }}</td>
                            </tr>

                            <tr>
                                <th>Área Total</th>
                                <td>{{ $row_area_total }} m²</td>
                            </tr>

                            <tr>
                                <th>Área Construida</th>
                                <td>{{ $row_area_construida }} m²</td>
                            </tr>

                            <tr>
                                <th>Precio de Alquiler</th>
                                <td>{{ $row_moneda.$row_precio_alquiler }}</td>
                            </tr>

                            <tr>
                                <th>Precio de Venta</th>
                                <td>{{ $row_moneda.$row_precio_venta }}</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="col-md-8">
                        <h3>Descripción</h3>

                        <div class="entry-content">
                            <div class="addthis_sharing_toolbox"></div>

                            {!! $row_contenido !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="gallery">

        <h3>Fotos de Inmueble</h3>

        <div class="grid">
            <div class="grid-sizer"></div>
            @foreach($inmueble->image as $item)
                {{--*/
                $fotos_imagen = '/upload/'.$item->imagen_carpeta.$item->imagen;
                /*--}}

                <div class="grid-item grid-item--width2">

                    <a class="b-link-stripe b-animate-go fancybox" href="{{ $fotos_imagen }}" data-fancybox-group="gallery" >
                        <img src="{{ $fotos_imagen }}" class="img-responsive img-style row6" alt="">
                        <div class="b-wrapper">
                            <span class="b-animate b-from-left b-delay03 ">
                                <img class="img-responsive zoom-img img-circle" src="/images/e.png" alt=""/>
                            </span>
                        </div>
                    </a>

                </div>

            @endforeach

        </div>

    </div>

</div>
@stop

@section('contenido_footer')

    {!! HTML::script('js/fancybox/jquery.fancybox.js?v=2.1.4') !!}

    {!! HTML::script('https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js') !!}

    <script>
        $(document).on("ready", function() {

            $('.fancybox').fancybox();

            $('.grid').masonry({
                columnWidth: '.grid-sizer',
                itemSelector: '.grid-item',
                percentPosition: true,
                fitWidth: true
            });

        });
    </script>
@stop