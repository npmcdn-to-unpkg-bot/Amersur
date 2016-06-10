@extends('layouts.frontend')

{{--*/
$row_id = $proyecto->id;
$row_titulo = $proyecto->titulo;
$row_descripcion = $proyecto->descripcion;
$row_contenido = $proyecto->contenido;
$row_imagen = '/upload/'.$proyecto->imagePr()->imagen_carpeta.'1200x600/'.$proyecto->imagePr()->imagen;
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

                    <div class="col-md-10" style="margin: 0 auto;float: none;">
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

        <h3>Fotos de Proyecto</h3>

        <div class="grid">
            <div class="grid-sizer"></div>
            @foreach($proyecto->image as $item)
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