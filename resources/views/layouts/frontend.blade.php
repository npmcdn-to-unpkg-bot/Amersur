<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $comConfig->titulo }}</title>

    <meta name="description" content="{{ $comConfig->description }}" />
    <meta name="keywords" content="{{ $comConfig->keywords }}" />
    <meta name="robots" content="index, follow"/>

    {{-- Bootstrap --}}
    {!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css') !!}
    {!! HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css') !!}
    {{-- Estilos --}}
    {!! HTML::style('css/estilos.css') !!}
    {{-- Google Font --}}
    {!! HTML::style('http://fonts.googleapis.com/css?family=Marvel:400,400italic,700,700italic') !!}
    {!! HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800') !!}

    @yield('contenido_header')

</head>
<body>
<div class="container-fluid">
    <div class="row">

        <!--side-bar-->
        <div class="col-sm-3 col-md-2 sidebar">
            <div class="logo">
                <a href="/"><img src="/images/logo.png" alt="logo"/></a>
            </div>
            <div class="top-nav">
                <span class="menu-icon"><img src="/images/menu-icon.png" alt=""/></span>
                <div class="nav1">
                    <ul class=" nav nav-sidebar">
                        <li {!! (Request::is('/') ? 'class="active"' : '') !!}><a href="/">Inicio</a></li>
                        <li {!! (Request::is('nosotros*') ? 'class="active"' : '') !!}><a href="/nosotros">Nosotros</a></li>
                        <li {!! (Request::is('proyecto*') ? 'class="active"' : '') !!}><a href="/proyectos">Proyectos</a></li>
                        <li {!! (Request::is('inmueble*') ? 'class="active"' : '') !!}><a href="/inmuebles">Inmuebles</a></li>
                        <li {!! (Request::is('contacto*') ? 'class="active"' : '') !!}><a href="/contacto">Contacto</a></li>
                    </ul>

                    @include('partials.social')

                </div>
            </div>
            <div class="clearfix"> </div>
            <p>© 2010 - Amersur S.A.C.</p>
        </div>
        <!--//side-bar-->

        @yield('contenido_body')

        <div class="clearfix"> </div>
    </div>
</div>

<!-- Custom Theme files -->
<script type="application/x-javascript">
    addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); }
</script>

{{-- jQuery --}}
{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js') !!}
{{-- Bootstrap --}}
{!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js') !!}

{{-- AddThis --}}
{!! HTML::script('//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5750772570126b33') !!}

{{-- Script Menu --}}
<script>
    $( "span.menu-icon" ).click(function() {
        $( ".nav1" ).slideToggle( 300, function() {
            // Animation complete.
        });
    });
</script>

{{-- Script --}}
{!! HTML::script('js/move-top.js') !!}
{!! HTML::script('js/easing.js') !!}
<script>
    jQuery(document).ready(function($) {
        $(".scroll").click(function(event){
            event.preventDefault();
            $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
        });
    });
</script>

@yield('contenido_footer')

</body>
</html>