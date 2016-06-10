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
                $row_url = route('frontend.proyecto', [$item->id, $item->slug_url]);
                $row_descripcion = $item->descripcion;
                $row_imagen = '/upload/'.$item->imagePr()->imagen_carpeta.'350x240/'.$item->imagePr()->imagen;
                /*--}}
                <div class="col-sm-6 col-md-4 row-grids">
                    <div class="srvs-thumbnail thumbnail">
                        <a href="{{ $row_url }}"><img src="{{ $row_imagen }}" alt="{{ $row_titulo }}"></a>
                        <div class="srvs-caption caption">
                            <h4><a href="{{ $row_url }}">{{ $row_titulo }}</a></h4>
                            <p>{{ $row_descripcion }}</p>
                        </div>
                    </div>
                </div>
                @endforeach

                    <div class="col-sm-12 col-xs-12 text-center">
                        {!! $proyectos->appends(Request::all())->render() !!}
                    </div>

            </div>
        </div>

    </div>

</div>
@stop

@section('contenido_footer')
@stop