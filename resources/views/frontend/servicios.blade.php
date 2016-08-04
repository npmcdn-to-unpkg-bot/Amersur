@extends('layouts.frontend')

@section('contenido_header')
@stop

@section('contenido_body')
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main about-main">

    <div class="services">

        <h3>Servicios</h3>

        <div class="services-info">
            <div class="work-grids">

                @foreach($rows as $row)
                {{--*/
                $row_titulo = $row->titulo;
                $row_url = route('frontend.servicio', [$row->id, $row->slug_url]);
                $row_descripcion = $row->descripcion;
                /*--}}
                <div class="col-md-4 resume-grid">
                    <div class="resume">
                        <h4>{{ $row_titulo }}</h4>
                        <p>{{ $row_descripcion }}</p>
                        <a class="btn btn-primary" href="{{ $row_url }}" data-target="#ajax" data-toggle="modal">Leer más</a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

    </div>

</div>
@stop

@section('contenido_footer')

    <!-- ajax -->
    <div class="modal fade modal-scroll" id="ajax" role="basic" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="/assets/global/img/loading-spinner-grey.gif" alt="" class="loading">
                    <span> &nbsp;&nbsp;Cargando... </span>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        $(document).on("ready", function() {
            carga = '<div class="modal-body"><img src="/assets/global/img/loading-spinner-grey.gif" alt="" class="loading"><span> &nbsp;&nbsp;Cargando... </span></div>';

            $("#ajax").on("hidden.bs.modal", function() {
                $("#ajax .modal-content").empty().html(carga);
            });

            // fix stackable modal issue: when 2 or more modals opened, closing one of modal will remove .modal-open class.
            $('body').on('hide.bs.modal', function() {
                if ($('.modal:visible').size() > 1 && $('html').hasClass('modal-open') === false) {
                    $('html').addClass('modal-open');
                } else if ($('.modal:visible').size() <= 1) {
                    $('html').removeClass('modal-open');
                }
            });

            // fix page scrollbars issue
            $('body').on('show.bs.modal', '.modal', function() {
                if ($(this).hasClass("modal-scroll")) {
                    $('body').addClass("modal-open-noscroll");
                }
            });

            // fix page scrollbars issue
            $('body').on('hidden.bs.modal', '.modal', function() {
                $('body').removeClass("modal-open-noscroll");
            });

            // remove ajax content and remove cache on modal closed
            $('body').on('hidden.bs.modal', '.modal:not(.modal-cached)', function () {
                $(this).removeData('bs.modal');
            });
        });
    </script>
@stop