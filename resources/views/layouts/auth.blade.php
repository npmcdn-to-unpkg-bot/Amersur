<!DOCTYPE html>
<!--[if IE 8]> <html lang="es" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="es" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="es" class="no-js">
<!--<![endif]-->

<head>
    <meta charset="utf-8"/>
    <title>Administrador</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>

    {{-- ENLACE EXTERNO --}}
    {!! HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all') !!}
    {!! HTML::style('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css') !!}
    {!! HTML::style('https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.2.3/css/simple-line-icons.css') !!}
    {!! HTML::style('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css') !!}
    {!! HTML::style('assets/global/plugins/uniform/css/uniform.default.css') !!}
    {!! HTMl::style('assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') !!}

    {{-- ESTILOS DE PAGINA --}}
    {!! HTML::style('assets/admin/pages/css/login-soft.css') !!}

    {{-- THEME STYLES --}}
    {!! HTML::style('assets/global/css/components.css') !!}
    {!! HTML::style('assets/global/css/plugins.css') !!}
    {!! HTML::style('assets/admin/layout/css/layout.css') !!}
    {!! HTML::style('assets/admin/layout/css/themes/default.css') !!}
    {!! HTML::style('assets/admin/layout/css/custom.css') !!}

    @yield('contenido_header')

</head>
<!-- END HEAD -->
<body class="login">
<!-- BEGIN LOGO -->
<div class="logo">
    <img src="/assets/admin/logo-admin.png" alt="Administrador de Contenido">
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler"></div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">

    @yield('contenido_body')

</div>
<!-- END LOGIN -->

<!-- BEGIN COPYRIGHT -->
<div class="copyright">2016 &copy;</div>
<!-- END COPYRIGHT -->

<!--[if lt IE 9]>
{!! HTML::script('assets/global/plugins/respond.min.js') !!}
{!! HTML::script('assets/global/plugins/excanvas.min.js') !!}
<![endif]-->

{{-- ENLACES EXTERNOS --}}
{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery-migrate-1.2.1.min.js') !!}
{!! HTML::script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js') !!}
{!! HTML::script('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js') !!}

{!! HTML::script('assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery.blockui.min.js') !!}
{!! HTML::script('assets/global/plugins/jquery.cokie.min.js') !!}
{!! HTML::script('assets/global/plugins/uniform/jquery.uniform.min.js') !!}
{!! HTML::script('assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') !!}

<!-- BEGIN PAGE LEVEL PLUGINS -->
{!! HTML::script('assets/global/plugins/jquery-validation/js/jquery.validate.min.js') !!}
{!! HTML::script('assets/global/plugins/backstretch/jquery.backstretch.min.js') !!}

{{-- BEGIN PAGE LEVEL SCRIPTS --}}
{!! HTML::script('assets/global/scripts/metronic.js') !!}
{!! HTML::script('assets/admin/layout/scripts/layout.js') !!}
{!! HTML::script('assets/admin/layout/scripts/quick-sidebar.js') !!}
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init() // init quick sidebar

        // init background slide images
        $.backstretch([
            "/assets/admin/pages/media/bg/1.jpg",
            "/assets/admin/pages/media/bg/2.jpg",
            "/assets/admin/pages/media/bg/3.jpg",
            "/assets/admin/pages/media/bg/4.jpg"
        ], {
            fade: 1000,
            duration: 8000
        }
        );
    });
</script>

@yield('contenido_footer')

</body>
<!-- END BODY -->
</html>