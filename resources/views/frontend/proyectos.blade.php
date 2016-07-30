@extends('layouts.frontend')

@section('contenido_header')
@stop

@section('contenido_body')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main about-main">

    <div class="services">

        <h3>Proyectos</h3>

        <!--service-page-->
        <div class="servcs-page">
            <div class="srvs-row row">

                @foreach($proyectos as $item)
                {{--*/
                $row_titulo = $item->titulo;
                $row_url = $item->enlace;
                $row_descripcion = $item->contenido;
                $row_imagen = url('/upload/'.$item->imagePr()->imagen_carpeta.'350x350/'.$item->imagePr()->imagen);
                /*--}}
                <div class="col-sm-6 col-md-4 row-grids">
                    <div class="srvs-thumbnail thumbnail">
                        <a href="{{ $row_url }}" target="_blank"><img class="img-row" data-original="{{ $row_imagen }}" alt="{{ $row_titulo }}"></a>
                        <div class="srvs-caption caption">
                            <h4><a href="{{ $row_url }}">{{ $row_titulo }}</a></h4>
                            <p>{!! $row_descripcion !!}</p>
                            <a class="info-proyecto" href="{{ route('frontend.contacto.get').'?a='.$row_titulo }}">Pedir más información</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            <div class="col-sm-12 col-xs-12 text-center">
                {!! $proyectos->appends(Request::all())->render() !!}
            </div>
        </div>

    </div>

</div>
@stop

@section('contenido_footer')
    {{-- LazyLoad --}}
    {!! HTML::script('https://cdnjs.cloudflare.com/ajax/libs/jquery.lazyload/1.9.1/jquery.lazyload.min.js') !!}
    <script>
        $(document).on("ready", function() {
            $("img.img-row").lazyload({
                effect: "fadeIn",
                threshold : 200
            });
        });
    </script>


    {{-- Masonry --}}
    {!! HTML::script('https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js') !!}
    <script>
        $(document).on("ready", function() {
            $('.srvs-row').masonry({
                itemSelector: '.row-grids',
                columnWidth: 345
            });
        });
    </script>
@stop