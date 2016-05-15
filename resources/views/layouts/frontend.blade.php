<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amersur</title>

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
                <a href="/"><img src="images/logo.png" alt="logo"/></a>
            </div>
            <div class="top-nav">
                <span class="menu-icon"><img src="images/menu-icon.png" alt=""/></span>
                <div class="nav1">
                    <ul class=" nav nav-sidebar">
                        <li class="active"><a href="/">Inicio</a></li>
                        <li><a href="nosotros">Nosotros</a></li>
                        <li><a href="servicios">Servicios</a></li>
                        <li><a href="galerias">Galerías</a></li>
                        <li><a href="testimonios">Testimonios</a></li>
                        <li><a href="contacto">Contacto</a></li>
                    </ul>
                    <div class="social-icons">
                        <ul>
                            <li><a href="#"></a></li>
                            <li><a href="#" class="fb"></a></li>
                            <li><a href="#" class="be"></a></li>
                            <li><a href="#" class="gg"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"> </div>
            <p>© 2016 - Amersur S.A.C.</p>
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